<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionConfirmationRequest;
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
            $event = $eventgenerator->event()
                ->where('parameters', $request->string('parameter')->trim())
                ->where('active', true)
                ->first();
            if (!$event) {
                $event = new Event();
            }
            $event->eventgenerator()->associate($eventgenerator);
            $event->parameters = $request->string('parameter')->trim();
            $event->active = true;
            $event->save();

            $subscription = new Subscription();
            $subscription->event()->associate($event);
            $subscription->email = $request->string('email')->trim();
            $subscription->active = true;
            $subscription->confirmation_start = Carbon::now();
            $subscription->push();

            Mail::to($subscription->email->toString())->send(new SubscriptionConfirmationRequest($subscription));

            $resp['success'] = true;
        }
        return response()->json($resp);
    }

    public function confirm(Subscription $subscription)
    {
        $subscription->confirm();
        $subscription->save();
        return response()->json(['success' => true]);
    }
}
