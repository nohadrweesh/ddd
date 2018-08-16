<?php

namespace App\DomainModelLayer\Schools;

use Analogue\ORM\EntityMap;
use App\DomainModelLayer\Accounts\Account;
use App\DomainModelLayer\Schools\Classroom;
use App\DomainModelLayer\Journeys\Quiz;
use App\DomainModelLayer\Journeys\TaskProgress;
use App\DomainModelLayer\Accounts\Role;
use App\DomainModelLayer\Schools\School;
use App\DomainModelLayer\Accounts\UserRole;
use App\DomainModelLayer\Accounts\Notification;
use App\DomainModelLayer\Accounts\UserPosition;

class SchoolMap extends EntityMap {

    protected $table = 'school';

    public $timestamps = true;
    public $softDeletes = true;
    protected $deletedAtColumn = "school.deleted_at";

    public function account(School $school)
    {
        return $this->belongsTo($school, Account::class, 'account_id', 'id');
    }

}