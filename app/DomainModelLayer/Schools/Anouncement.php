<?php

namespace App\DomainModelLayer\Schools;

use App\ApplicationLayer\Schools\Dtos\SchoolDto;
use App\DomainModelLayer\Accounts\Account;
use App\DomainModelLayer\Schools\Classroom;
use App\DomainModelLayer\Accounts\Role;
use App\DomainModelLayer\Accounts\UserRole;
use App\Helpers\UUID;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Analogue\ORM\Entity;
use Analogue\ORM\EntityCollection;
use App\DomainModelLayer\Accounts\Notification;
use App\DomainModelLayer\Accounts\UserPosition;


class School extends Entity
{
    //region Getters & Setters

    public function __construct(Account $account,SchoolDto $schoolDto)
    {
        $this->account_id = $account->getId();
        $this->name = $schoolDto->name;
        $this->logo_url = $schoolDto->logoUrl;
    }

    public function setAccountId($accountId){
        $this->account_id = $accountId;
    }

    public function getAccountId(){
        return $this->account_id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setLogoUrl($logoUrl){
        $this->logo_url = $logoUrl;
    }

    public function getLogoUrl(){
        return $this->logo_url;
    }
}

