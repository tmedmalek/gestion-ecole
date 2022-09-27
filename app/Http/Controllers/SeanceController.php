<?php

namespace App\Http\Controllers;

use App\Exceptions\IsExisteExcetion;
use App\Exceptions\NotFoundException;
use App\Http\Requests\UpdateSeanceRequest;
use App\Http\Resources\SeanceResource;
use App\Http\Resources\SeanceResourceCollection;
use App\Models\Seance;
use App\Services\SeanceService;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    public function __construct(private SeanceService $seanceService)
    {
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SeanceResourceCollection(Seance::all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seance = $this->seanceService->getseance($id);
        if (is_null($seance)) {
            throw new NotFoundException(['code' => -1, 'message' => 'seance not found']);
        }
        return response(
            [
                'success' => 1,
                'data' => new SeanceResource($seance)
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
    public function update(UpdateSeanceRequest $request, $id)
    {
        $seance = $this->seanceService->getseance($id);
        if (is_null($seance)) {
            throw new NotFoundException(['code' => -1, 'message' => 'seance not found']);
        }


        $matProf = $this->seanceService->checkProfmatExiste($request['matiere_prof_id']);
        if (is_null($matProf)) {
            throw new NotFoundException(['code' => -3, 'message' => 'matiere_professeur not found']);
        }


        $classe = $this->seanceService->checkClasseExiste($request['classe_id']);
        if (is_null($classe)) {
            throw new NotFoundException(['code' => -4, 'message' => 'classe not found']);
        }


        $salle = $this->seanceService->checkSalleExiste($request['salle_id']);
        if (is_null($salle)) {
            throw new NotFoundException(['code' => -5, 'message' => 'salle not found']);
        }


        $seance = $this->seanceService->checkSeanceNotExiste($request->validated(), $id);
        if (isset($seance)) {
            throw new IsExisteExcetion(['code' => -2, 'name' => 'seance']);
        }


        $profeseur = $this->seanceService->getProf($request['matiere_prof_id']);
        $matiere = $this->seanceService->getMat($request['matiere_prof_id']);
        $seance->classe()->associate($request['classe_id']);
        $seance->matiereProf()->associate($request['matiere_prof_id']);
        $seance->salle()->associate($request['salle_id']);
        $seance->professeur = $profeseur->first_name . ' ' . $profeseur->last_name;
        $seance->matiere = $matiere['name'];
        $seance->heure_debut = $request['heure_debut'];
        $seance->heure_fin = $request['heure_fin'];
        $seance->jour_seance = $request['jour_seance'];
        $seance->save();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seance = $this->seanceService->getseance($id);
        if (is_null($seance)) {
            throw new NotFoundException(['code' => -1, 'message' => 'seance not found']);
        }
        $seance->delete();
        return  response(['success' => 1, 'message' => 'calendrier is deleted'], 201);
    }
}
