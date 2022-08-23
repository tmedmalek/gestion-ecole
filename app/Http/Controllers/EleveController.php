<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEleveRequest;
use App\Http\Resources\EleveResource;
use App\Models\Eleve;


class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            [
                'success' => 1,
                'data' => EleveResource::collection(Eleve::all())
            ],
            201
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEleveRequest $request)
    {
        $eleve = Eleve::firstWhere('first_name', $request->first_name);

        if (isset($eleve)) {
            return response(['success' => -1, 'message' => 'eleve is existe'], 200);
        }

        $eleve = Eleve::create($request->validated());
        return response(['success' => 1, 'message' => 'eleve is create'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $eleve = Eleve::firstwhere('id', $id);
        if (is_null($eleve)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
        return response(
            [
                'success' => 1,
                'data' => new EleveResource($eleve)
            ],
            201
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEleveRequest $request, $id)
    {
        $eleve = Eleve::where('id', $id)->first();
        if (is_null($eleve)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $eleve_by_name = Eleve::where('first_name', $request->first_name)->first();
        if (isset($eleve_by_name) && $eleve_by_name->id !== $eleve->id) {
            return response(['success' => -2, 'message' => 'name existe'], 200);
        }

        $eleve->update($request->only([
            'first_name',
            'last_name',
            'dob'
        ]));
        return response(['success' => 1, 'message' => 'Eleve is updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eleve = Eleve::where('id', $id)->first();
        if (is_null($eleve)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $eleve->delete();
        return response(['success' => 1, 'message' => 'eleve is deleted'], 201);
    }
}
