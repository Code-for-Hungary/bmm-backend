<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionConfirmationRequest;
use App\Mail\SubscriptionManagement;
use App\Models\Event;
use App\Models\Eventgenerator;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resp = [
            'success' => false
        ];

        if (config('bmm.restricted_to_email') &&
            !in_array(
                $request->string('email')->trim()->toString(),
                explode(';', config('bmm.restricted_to_email'))
            )
        ) {
            return response()->json($resp);
        }

        $eventgenerator = Eventgenerator::find($request->input('eventgenerator'));
        if ($eventgenerator) {
            $eventtype = $request->integer('eventtype');
            switch ($eventtype) {
                case 1:
                    $event = $eventgenerator->event()
                        ->where('parameters', $request->string('parameter')->trim())
                        ->where('type', $eventtype)
                        ->where('active', true)
                        ->first();
                    break;
                case 2:
                    $event = $eventgenerator->event()
                        ->where('type', $eventtype)
                        ->where('active', true)
                        ->first();
            }
            if (!$event) {
                $event = new Event();
            }
            $event->eventgenerator()->associate($eventgenerator);
            if ($request->string('parameter')->trim()->lower()->toString() !== 'null') {
                $event->parameters = $request->string('parameter')->trim();
            }
            $options = [];

            $rawInput = file_get_contents('php://input');
            $pairs = explode('&', $rawInput);
            foreach ($pairs as $pair) {
                if (!empty($pair)) {
                    list($key, $value) = array_pad(explode('=', $pair, 2), 2, '');
                    $key = urldecode($key);
                    $value = urldecode($value);

                    if (strpos($key, 'option_') === 0) {
                        $optionKey = substr($key, strlen('option_'));
                        if (!isset($options[$optionKey])) {
                            $options[$optionKey] = [];
                        }
                        $options[$optionKey][] = $value;
                    }
                }
            }

            $event->selected_options = $options;
            $event->type = $eventtype;
            $event->active = true;
            $event->save();

            $subscription = new Subscription();
            $subscription->event()->associate($event);
            $subscription->email = $request->string('email')->trim();
            $subscription->confirmation_start = Carbon::now();
            $subscription->push();

            Mail::to($subscription->email->toString())->send(new SubscriptionConfirmationRequest($subscription));

            $resp['success'] = true;
        }
        return response()->json($resp);
    }

    public function confirm(Subscription $subscription)
    {
        if (!$subscription->confirmed) {
            $subscription->confirm();
            $subscription->save();
        }
        return response()->json(['success' => true]);
    }

    public function unsubscribe(Subscription $subscription)
    {
        $subscription->active = false;
        $subscription->save();
        return response()->json(['success' => true]);
    }

    public function manage(Request $request)
    {
        $email = $request->string('email')->trim();
        
        $subscriptions = Subscription::with('event.eventgenerator')
            ->where('email', $email)
            ->where('confirmed', true)
            ->where('active', true)
            ->get();

        if ($subscriptions->count() > 0) {
            Mail::to($email->toString())->send(new SubscriptionManagement($subscriptions, $email->toString()));
        }

        return response()->json(['success' => true]);
    }
}
