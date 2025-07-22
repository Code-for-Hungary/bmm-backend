<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Mail\SubscriptionNotification;
use App\Models\Event;
use App\Models\Eventgenerator;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{

    public function indexByGenerator(Request $request, Eventgenerator $eventgenerator)
    {
        // If the route uses eventgenerator.api.key middleware, use the authenticated eventgenerator
        if ($request->has('authenticated_eventgenerator')) {
            $authenticatedEventgenerator = $request->get('authenticated_eventgenerator');
            // Verify that the route parameter matches the authenticated eventgenerator
            if ($eventgenerator->id !== $authenticatedEventgenerator->id) {
                return response()->json(['error' => 'Eventgenerator mismatch'], 403);
            }
            $eventgenerator = $authenticatedEventgenerator;
        }

        return EventResource::collection(
            $eventgenerator->event()
                ->where('active', true)
                ->get()
        );
    }

    public function notify(Request $request, Event $event)
    {
        // Use the authenticated eventgenerator from middleware
        if (!$request->has('authenticated_eventgenerator')) {
            return response('Unauthorized', 401);
        }
        
        $eventgenerator = $request->get('authenticated_eventgenerator');
        
        if ($event->eventgenerator->id !== $eventgenerator->id) {
            return response('Bad Request', 400);
        }
        
        $eventContent = $request->string('content')->trim()->toString();
        $subs = $event->subscriptions()
            ->where('active', true)
            ->get();

        /** @var Subscription $sub */
        foreach ($subs as $sub) {
            Mail::to($sub->email)->send(new SubscriptionNotification($sub, $eventContent));
        }
        return response('OK', 200);
    }

}
