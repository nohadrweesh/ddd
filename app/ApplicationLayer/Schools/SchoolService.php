<?php

namespace App\ApplicationLayer\Schools;

use App\DomainModelLayer\Schools\Repositories\ISchoolMainRepository;
use Illuminate\Http\Request;
class SchoolService
{
    //region Properties
   
    private $schoolRepository;

    //endregion

    //region Constructor
    public function __construct(ISchoolMainRepository $schoolRepository){
       
        $this->schoolRepository = $schoolRepository;

    }

    public function AddSchool(Request $request){
        $this->schoolRepository->beginDatabaseTransaction();
        

       $school=School::create($request->all());

       

        //Store Account, User and User Role in database
        $this->schoolRepository->AddSchool($school);
        //User is stored now with his role and account

        $subscriptionDto = new SubscriptionDto;
        $subscriptionDto->StartDate = Carbon::now();
        $subscriptionDto->EndDate = null;

        $plan = $this->schoolRepository->getPlanByName($userDto->plan);
        if($plan == null)
            throw new BadRequestException(trans("locale.plan_not_found"));

        $updated_plan = $this->schoolRepository->getlastupdated($plan, $account_type->getId());
        if($updated_plan == null)
            throw new BadRequestException(trans("locale.version_plan_not_found"));

        $subscription = new Subscription($subscriptionDto, $updated_plan, $account);
        $this->schoolRepository->storeSubscription($subscription);

        if($userDto->accounttype == 'School'){
            $schoolDto = new SchoolDto;
            $schoolDto->name = $userDto->school_name;

            $school = new School($account, $schoolDto);
            $this->schoolRepository->addSchool($school);
            $this->schoolRepository->addDefaultGrades($school);
        }
        $event = new UserCreatedHandle();
        $school_name = (($userDto->school_name != null && !empty($userDto->school_name)) ? $userDto->school_name : $user->getUsername());
        $event->sendEmail($account, $user, $school_name);

        $this->schoolRepository->commitDatabaseTransaction();
        return UserDtoMapper::CustomerMapper($user);
    }

   

}