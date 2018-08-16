<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApplicationLayer\Schools\Interfaces\ISchoolMainService;

use App\School;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     
     */
     
     private $schoolService;

    /*public function __construct(ISchoolMainService $schoolService){


       
        $this->schoolService = $schoolService;
    }
     */
    public function index()
    {
        //$schools=School::all();
        // return view('schools/all_schools',compact('schools'));
         return view('schools/all_schools');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('schools/new_school');
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
       // $bool=$this->schoolService->AddSchool($request);
        //return ($bool)?"school inserted sucessfully ":"failed to insert ";
        $school=School::create($request->all());
        return "Done with ".$school;
    }

    
}
