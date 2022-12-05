<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetitionCollection;
use App\Http\Resources\PetitionResource;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource. Note: default return was changed.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        // $petitions = Petition::all();
        // return PetitionResource::collection($petitions);
        // or
        // note: this will not show additional meta data like version or/and author
        // return PetitionResource::collection(Petition::all());
        // or
        // return new PetitionCollection(Petition::all());

        // return response()->json(new PetitionCollection(Petition::all()), 200 );

        return response()->json(new PetitionCollection(Petition::all()), Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage Note: default return was changed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PetitionResource
     */
    public function store(Request $request)
    {
        $petition = Petition::create($request->only([
            'title', 'description', 'category', 'author', 'signees' 
        ]));

        return new PetitionResource($petition);
    }

    /**
     * Display the specified resource. Change default return 
     *
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function show(Petition $petition)
    {
        return new PetitionResource($petition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Petition $petition)
    {
        $petition->update($request->only([
            'title', 'description', 'category', 'author', 'signees'
        ]));

        return new PetitionResource($petition);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petition  $petition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petition $petition)
    {
        $petition->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
