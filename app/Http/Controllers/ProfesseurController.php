<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfesseurResource;
use App\Models\Professeur;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProfesseurResource::collection(Professeur::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professeur = Professeur::firstwhere('id', $id);
        if (is_null($professeur)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }
        return new ProfesseurResource(Professeur::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professeur = Professeur::where('id', $id)->first();
        if (is_null($professeur)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $professeur->delete();
        return response(['success' => 1, 'message' => 'professeur is deleted'], 201);
    }
}
