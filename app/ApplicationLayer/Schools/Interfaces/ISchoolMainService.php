<?php

namespace App\ApplicationLayer\Schools\Interfaces;
use Illuminate\Http\Request;



interface ISchoolMainService
{
 
    public function AddSchool(Request $request);
}
