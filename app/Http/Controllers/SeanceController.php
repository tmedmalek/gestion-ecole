<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Resources\SeanceResource;
use App\Http\Resources\SeanceResourceCollection;
use App\Models\Classe;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // $weekDays = Seance::WEEK_DAYS;
        // $classes = Classe::all();
        // $this->seanceService->genereteCalendrierData($classes, $weekDays);
        // return response(['success' => 1, 'message' => 'calendrier is generated']);
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
        return  response(['success' => 1, 'message' => 'calendrier is deleted'], 201);
    }
}
