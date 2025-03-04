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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resp = [
            'success' => false
        ];

        $eventgenerator = new Eventgenerator();
        $eventgenerator->name = $request->string('name')->trim();
        $eventgenerator->description = $request->string('description')->trim();
        $eventgenerator->extrainfo = $request->string('extrainfo')->trim();
        $eventgenerator->options_schema = $request->json('options_schema');
        $eventgenerator->active = true;
        $eventgenerator->save();

        $resp['uuid'] = $eventgenerator->id;
        $resp['success'] = true;

        return response()->json($resp);
    }


}
