<?php

namespace App\Http\Controllers\Journeys;


use App\ApplicationLayer\Journeys\Interfaces\IJourneyMainService;


class ActivityController extends Controller
{
    private $journeyService;

    public function __construct(IJourneyMainService $journeyService){
        
        $this->journeyService = $journeyService;
    }

    public function index(){
        return "App\Http\Controllers\Journeys\ActivityController";
    }

   
    public function getFreeActivitiesAndJourneys(){
        $response = $this->journeyService->getFreeActivitiesAndJourneys();
        return $response;
        //return $this->handleResponse($response);
    }

  
}