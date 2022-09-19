<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Services\CalendrierService;
use Illuminate\Http\Response;

class CalendrierController extends Controller
{
    public function index(CalendrierService $calendrierService)
    {
        $weekDays = Seance::WEEK_DAYS;
        $calendarData = $calendrierService->generateCalendarData($weekDays, request()->input('classe_id'));
        return response($calendarData, Response::HTTP_OK);
    }
}
