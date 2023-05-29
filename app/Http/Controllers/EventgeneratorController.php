<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventgeneratorResource;
use App\Models\Eventgenerator;
use Illuminate\Http\Request;

class EventgeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EventgeneratorResource::collection(
            Eventgenerator::select()
                ->where('active', '=', true)
                ->orderBy('name', 'asc')
                ->get()
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Eventgenerator $eventgenerator)
    {
        return new EventgeneratorResource($eventgenerator);
    }

}
