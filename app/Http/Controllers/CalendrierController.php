<?php

namespace App\Http\Controllers;

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
}
