<?php

namespace App\Http\Controllers;

use App\Exceptions\IsExisteExcetion;
use App\Exceptions\NotFoundException;
use App\Http\Requests\StoreProfesseurRequest;
use App\Http\Requests\UpdateProfesseurRequest;
use App\Http\Resources\ProfesseurResource;
use App\Http\Resources\ProfesseurResourceCollection;
use App\Models\Professeur;
use App\Services\ProfesseurService;
use App\Traits\MatiereTrait;

class ProfesseurController extends Controller
{
    use MatiereTrait;
    public function __construct(private ProfesseurService $professeurService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'success' => 1,
            'data' => new ProfesseurResourceCollection(Professeur::all())
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
        $professeur =  $this->professeurService->checkProfNotExiste('email', $request['email']);
        if (isset($professeur)) {
            throw new IsExisteExcetion(['code' => -1, 'name' => 'email']);
        }
        $professeur = $this->professeurService->checkProfNotExiste('cin', $request['cin']);
        if (isset($professeur)) {
            throw new IsExisteExcetion(['code' => -1, 'name' => 'cin']);
        }
        $request['password'] = bcrypt($request['password']);
        $professeur = Professeur::create($request->validated());
        $this->setMatiers($professeur, $request['matieres']);
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
        $professeur = $this->professeurService->getProf($id);
        if (is_null($professeur)) {
            throw new NotFoundException(['code' => -1, 'message' => 'Professeur not found']);
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
    public function update(UpdateProfesseurRequest $request, $id)
    {

        $professeur =  $this->professeurService->checkEmailUnique($request['email'], $id);
        if (isset($professeur) && $id != $professeur->id) {
            throw new IsExisteExcetion(['code' => -2, 'name' => 'Professeur_email']);
        }
        $professeur =  $this->professeurService->checkCinUnique($request['cin'], $id);
        if (isset($professeur) && $id != $professeur->id) {
            throw new IsExisteExcetion(['code' => -3, 'name' => 'Professeur_cin existe']);
        }
        $professeur = $this->professeurService->getProf($id);
        if (is_null($professeur)) {
            throw new NotFoundException(['code' => -1, 'message' => 'Professeur not found']);
        }
        $matiere =  $this->professeurService->checkMatiresExiste($request['matieres']);
        if (is_null($matiere)) {
            throw new NotFoundException(['code' => -1, 'message' => 'matiere not found']);
        }
        $professeur->update($request->validated());
        $this->setMatiers($professeur, $request['matieres']);
        return response(['success' => 1, 'message' => 'professeur is updated'], 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $professeur = $this->professeurService->getProf($id);
        if (is_null($professeur)) {
            throw new NotFoundException(['code' => -1, 'message' => 'Professeur not found']);
        }
        $professeur->matieres()->detach();
        $professeur->delete();
        return  response(['success' => 1, 'message' => 'professeur is deleted'], 201);
    }
}
