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

    public function indexByGenerator(Eventgenerator $eventgenerator)
    {
        return EventResource::collection(
            $eventgenerator->event()
                ->where('active', true)
                ->get()
        );
    }

    public function notify(Request $request, Event $event)
    {
        $eventgenerator = Eventgenerator::find($request->get('uuid'));
        if (!$eventgenerator) {
            return response('Unauthorized', 401);
        }
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
