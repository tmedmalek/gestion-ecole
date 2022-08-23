<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfesseurRequest;
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
        return response([
            'success' => 1,
            'data' => ProfesseurResource::collection(Professeur::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfesseurRequest $request)
    {
        $professeur = Professeur::firstWhere('email', $request->email);

        if (isset($professeur)) {
            return response(['success' => -1, 'message' => 'professeur is existe'], 200);
        }

        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $professeur = Professeur::create($data);
        return response(['success' => 1, 'message' => 'professeur is create'], 201);
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
        return response(
            [
                'success' => 1,
                'data' => new ProfesseurResource($professeur)
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
    public function update(StoreProfesseurRequest $request, $id)
    {
        $Professeur = Professeur::where('id', $id)->first();
        if (is_null($Professeur)) {
            return response(['success' => -1, 'message' => 'is not found'], 200);
        }

        $Professeur = Professeur::where('email', $request->email)->first();
        if (isset($Professeur) && $Professeur->id !== $Professeur->id) {
            return response(['success' => -2, 'message' => 'email existe'], 200);
        }

        $Professeur->update(
        'first_name',
        'last_name',
        'date_naissance',
        'type',
        'email',
        'mobile',
        'adresse',
        'cin',
        'annee_afectation',
        'diplome',
        'grade',
        'salaire',
        'specialite',
        'street',
        'city',
        'gouverneant',
        'zipcode',
        );
        return response(['success' => 1, 'message' => 'Professeur is updated'], 201);
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
