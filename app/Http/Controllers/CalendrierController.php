<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Seance;
use App\Services\CalendrierService;
use Illuminate\Http\Response;

class CalendrierController extends Controller
{

    public function __construct(private CalendrierService $calendrierService)
    {
    }


    public function index($id)
    {
        $weekDays = Seance::WEEK_DAYS;
        $calendarData = $this->calendrierService->getCalendarData($weekDays, $id);
        return response($calendarData, Response::HTTP_OK);
    }


    public function store()
    {
        $weekDays = Seance::WEEK_DAYS;
        $classes = Classe::all();
        $this->calendrierService->genereteCalendrierData($classes, $weekDays);
        return response(['success' => 1, 'message' => 'calendrier is generated']);
    }


    public function destroy()
    {
        $seances = Seance::all();
        foreach ($seances as $seance) {
            $seance->delete();
        }
        return  response(['success' => 1, 'message' => 'calendrier is deleted'], 201);
    }
}
