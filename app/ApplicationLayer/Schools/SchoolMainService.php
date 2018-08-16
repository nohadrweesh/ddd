<?php
/**
 * Created by PhpStorm.
 * User: Hesham Eldeeb
 * Date: 0015, February 15, 2017
 * Time: 7:17 PM
 */

namespace App\ApplicationLayer\Schools;
use Illuminate\Http\Request;

use App\DomainModelLayer\Schools\Repositories\ISchoolMainRepository;




class SchoolMainService implements ISchoolMainService
{
    //region Properties
   
    private $schoolRepository;
    

    //endregion

    //region Constructor
    public function __construct(ISchoolMainRepository $schoolRepository){
       
        $this->schoolRepository = $schoolRepository;
       

    }


   public function AddSchool(Request $request){
        $schoolService = new SchoolService($this->schoolRepository);
        return $schoolService->AddSchool($request);
    }

    

}