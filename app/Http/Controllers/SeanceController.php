<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\StoreSeanceRequest;
use App\Http\Resources\SeanceResource;
use App\Http\Resources\SeanceResourceCollection;
use App\Models\Classe;
use App\Models\Salle;
use App\Models\Seance;
use App\Services\SeanceService;
use Carbon\Carbon;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $weekDays = Seance::WEEK_DAYS;
        $classes = Classe::all();
        $salles = Salle::all();
        $times = $this->seanceService->generateTimeRange('08:00', '18:00');
        foreach ($weekDays as $index => $day) {
            foreach ($times as $time) {
                foreach ($classes as $classe) {
                    $nb_heure = $classe->niveau->nb_heure_semaine;
                    foreach ($classe->niveau->matieres as $matiere) {
                        do {
                            foreach ($matiere->professeurs as $profeseur) {
                                //  $this->checkprofjourtime($profeseur->id, $time['start'], $time['end'], $day);
                                foreach ($salles as $salle) {
                                    $mat_prof = $this->seanceService->getMatiereProf($profeseur->id, $matiere->id);
                                    $seance = new Seance();
                                    $seance->classe()->associate($classe->id);
                                    $seance->matiereProf()->associate($mat_prof->id);
                                    $seance->salle()->associate($salle->id);
                                    $seance->professeur = $profeseur->first_name . ' ' . $profeseur->last_name;
                                    $seance->matiere = $matiere->name;
                                    $seance->heure_debut = $time['start'];
                                    $seance->heure_fin = $time['end'];
                                    $seance->jour_seance = $day;
                                    $seance->save();
                                }
                            }


                            --$nb_heure;
                        } while ($nb_heure == 0);
                    }
                }
            }
        }
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
            throw new NotFoundException(['code' => -4, 'message' => 'seance not found']);
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
    public function destroy()
    {
        // $seance = $this->seanceService->getseance($id);
        // if (is_null($seance)) {
        //     throw new NotFoundException(['code' => -4, 'message' => 'seance not found']);
        // }
        $seances = Seance::all();
        foreach ($seances as $seance) {
            $seance->delete();
        }
        return  response(['success' => 1, 'message' => 'seance is deleted'], 201);
    }
}
