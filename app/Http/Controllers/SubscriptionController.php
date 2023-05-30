<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Eventgenerator;
use App\Models\Subscription;
use Illuminate\Http\Request;

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
            $subscription->push();

            $resp['success'] = true;
        }
        return response()->json($resp);
    }

    public function confirm(Subscription $subscription)
    {
    }
}
