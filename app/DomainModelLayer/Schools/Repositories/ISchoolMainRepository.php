<?php
/**
 * Created by PhpStorm.
 * User: RVM-13
 * Date: 1/23/2017
 * Time: 3:51 PM
 */

namespace App\DomainModelLayer\Schools\Repositories;

use App\ApplicationLayer\Schools\Dtos\ChargeDto;
use App\DomainModelLayer\Schools\Camp;
use App\DomainModelLayer\Schools\CampActivity;
use App\DomainModelLayer\Schools\CampActivityProgress;
use App\DomainModelLayer\Schools\CampUser;
use App\DomainModelLayer\Schools\DistributorCharge;
use App\DomainModelLayer\Schools\DistributorChargeDetails;
use App\DomainModelLayer\Schools\DistributorChargeUpgrade;
use App\DomainModelLayer\Schools\School;
use App\DomainModelLayer\Schools\ClassroomMember;
use App\DomainModelLayer\Schools\ClassroomJourney;
use App\DomainModelLayer\Schools\Classroom;
use App\DomainModelLayer\Schools\Course;
use App\DomainModelLayer\Schools\Grade;
use App\DomainModelLayer\Accounts\Account;
use App\DomainModelLayer\Schools\SchoolCamp;
use App\DomainModelLayer\Schools\SchoolCampDetail;
use App\DomainModelLayer\Schools\SchoolCharge;
use App\DomainModelLayer\Schools\SchoolChargeDetails;
use App\DomainModelLayer\Schools\SchoolChargesLog;
use App\DomainModelLayer\Schools\SchoolChargeUpgrade;
use App\DomainModelLayer\Schools\SchoolDistributorCamp;
use App\DomainModelLayer\Schools\StudentFinishCourse;
use App\DomainModelLayer\Schools\Group;
use App\DomainModelLayer\Accounts\User;
use App\DomainModelLayer\Schools\GroupMember;
use App\DomainModelLayer\Schools\StudentClickMission;
use App\DomainModelLayer\Schools\StudentPosition;
use App\DomainModelLayer\Schools\StudentProgress;
use App\DomainModelLayer\Accounts\Role;
use App\DomainModelLayer\Journeys\Task;

use App\DomainModelLayer\Schools\DistributorSubscription;

interface ISchoolMainRepository
{
    public function addSchool(School $school);
    public function addDefaultGrades(School $school);
    public function getGradeByName(School $school,$name);
    public function storeClassroom(Classroom $classroom);
    public function getClassroomByName($name);
    public function getClassroomById($id);

    public function getDistributors();
    public function getDistributorById($id);
    public function getCountryByCode($country_code);
    public function getCountries();
    public function getDefaultDistributors();

    public function getDistributorSubscriptionByCode($user_id,$code);

    public function emailDistributor($distributor_name,$plan_name,$students,$classrooms,$distributor_email,$admin_name,$admin_email,$school_name,$code,$upcomingCode, $upgrade = false);
    public function emailSubscription($account_name,$plan_name,$students,$classroom,$account_email,$plan = true, $upgrade = null);

    public function getAllTeachers($account_id,$limit = null,$grade_id = null,$search = null);
    public function getAllStudents($account_id,$limit = null,$grade_id = null,$search = null);
    public function getAllClassrooms($school_id,$limit = null,$grade_id = null,$search = null);
    public function getAllStudentsInClassroom($classroom_id,$limit = null,$search = null);
    public function getAllTeachersInClassroom($classroom_id,$limit = null,$search = null);


    public function getClassRoomMember(Classroom $classroom,User $user,Role $role);
    public function getDefaultGroupMember(Classroom $classroom,User $user,Role $role);
    public function deleteClassroomMember(ClassroomMember $classroomMember);
    public function deleteGroupMember(GroupMember $groupMember);
    public function storeClassroomMember(ClassroomMember $classroomMember);

    public function storeDistributorSubscription(DistributorSubscription $distributor_subscription);

    public function emailAlreadyExist($email);
    public function usernameAlreadyExist($username);
    public function getUnEnrolledStudents(User $user,Classroom $classroom,$limit,$search);
    public function getUnAssignedTeachers(User $user,Classroom $classroom,$limit,$search);


    public function getClassroomJourney($classroom_id,$journey_id);
    public function deleteClassroomJourney(ClassroomJourney $classroomJourney);
    public function deleteClassroom(Classroom $classroom);
    public function deleteClassroomMembers(User $user);
    public function deleteGroupMembers(User $user);
    public function storeGroupMember(GroupMember $groupMember);
    public function getTeacherClassrooms($user,$limit,$grade_id,$search);

    public function getCourseById($id);
    public function getStudentProgrss($task_id,$user_id,$course_id,$adventure_id);
    public function storeStudentProgress(StudentProgress $student_progress);
    public function deleteStudentProgress(StudentProgress $student_progress);
    public function getTeacherCourses($user,$limit,$classroom_id,$search);
    public function storeCourse(Course $course);

    public function storeStudentPosition(StudentPosition $student_position);
    public function deleteStudentPosition(StudentPosition $student_position);

    public function getStudentProgressByOrder($user_id, $order,$course_id,$adventure_id);
    public function deleteCourse(Course $course);
    public function deleteCourseAdventureDeadlines(Course $course);
    public function getStudentProgressInAdventure($user_id,$adventure_id,$course_id);

    public function getStudentsInGroup(Group $group,$limit,$search);
    public function getCompletedMissionsInCourse($course_id);
    public function getNeverPlayedMissionsInCourse($course_id);
    public function getTopStudents(Account $account,Grade $grade,$limit= 10);

    public function getGradeById($grade_id);
    public function getTopStudentsInClassroom(Account $account,Classroom $classroom,$limit=10);

    public function getCourseCreatedInRange(School $school,$from_time,$to_time);
    public function getCourseEndedInRange(School $school,$from_time,$to_time);
    public function getCoursesFinishedByStudents(School $school,$from_time,$to_time);

    public function storeStudentClickMission(StudentClickMission $studentClickMission);
    public function getStoreStudentClickMissionByTimeAndUser(User $user,$time);
    public function getStudentMissionClickByTime(Account $account,$from_time,$to_time,$classroom_ids = array());
    public function getStudentSolvedMissions(Account $account,$from_time,$to_time,$classroom_ids = array());
    public function getCourseAboutToStartForTeacher(User $user);
    public function getCourseEndedInRangeForTeacher(User $user,$from_time = null,$to_time = null);
    public function getIfStudentsProgressedInClassroom(Classroom $classroom,$students);

    public function checkClassroomNameUniqueInSchool(School $school,$classroomName);
    public function checkCourseNameUniqueInClassroom(Classroom $classroom,$courseName);
    public function storeStudentFinishCourse(StudentFinishCourse $studentFinishCourse);
    public function getStudentsFinishedCourse(Course $course);
    public function getStudentBlockingTasks($student_id);
    public function getFinishedCourseByAllStudentsInSchool(School $school);
    public function getClassroomsForAdmin(School $school,Grade $grade = null);
    public function getStudentLastPlayedTask($student_id);
    public function getStudentsFinishCourseForTeacher(User $user);
    public function getStudentAdventureDeadlinePassed(User $user);
    public function getCourseAdventureDeadline($courseAdventureDeadlineId);

    public function handleStripeCharge(ChargeDto $chargeDto);
    public function getSchoolPlanComponentCost($type, $quantity);
    public function getBundleById($bundle_id);
    public function storeSchoolCharge(SchoolCharge $schoolCharge);
    public function storeSchoolChargeDetails(SchoolChargeDetails $schoolChargeDetails);
    public function getNearestDiscount($type, $quantity);

    public function storeSchoolChargesLog(SchoolChargesLog $schoolChargesLog);
    public function storeSchoolChargeUpgrade(SchoolChargeUpgrade $schoolChargeUpgrade);
    public function getLatestBundleUpgrade(SchoolCharge $schoolCharge);
    public function getAllUpgradesAfter($id,SchoolCharge $schoolCharge);
    public function storeDistributorCharge(DistributorCharge $distributorCharge);
    public function storeDistributorChargeDetails(DistributorChargeDetails $distributorChargeDetails);
    public function getSchoolInvoicesLog($school_id,$limit);
    public function getSchoolPlanBundles();
    public function getSchoolPrices($type = null);

    public function getMaxNoOfStudentsAndClassrooms($account_id);
    public function storeDistributorChargeUpgrade(DistributorChargeUpgrade $distributorChargeUpgrade);
    public function deleteUnusedDistributorUpgrades($distributor_charge_id);
    public function getDistributorLastUpgrade($distributor_charge_id);
    public function sendCustomSubscriptionMail($school_name, $school_email, $plan_name = null, $students, $classrooms, $upgrade = false);
    public function getStudentProgressInClassroom($student_id, $classroom_id);
    public function getEnrolledStudent($account_id, $count = null);

    // camps
    public function getCampById($id);
    public function checkIfActiveCamp($camp_id);
    public function getRunningCampsInSchool($school_id, $count = null, $teacher_id = null);
    public function getUpcomingCampsInSchool($school_id, $count = null, $teacher_id = null);
    public function getCountOfPeopleInActiveCamps($school_id, $roleName);
    public function getTopStudentsInCamp(Account $account, $camp_id, $limit=10);
    public function getStudentSolveTaskByTime(Account $account, $from_time, $to_time, $camp_ids = null);
    public function getTaskSolvedByStudentByTime(Account $account, $from_time, $to_time, $camp_ids = null);
    public function getAllCampsByStatus($school_id, $status, $limit = null, $search = null, $count = false, $camp_ids = null);
    public function deleteCamp(Camp $camp);
    public function getAllStudentsInCamp($camp_id, $limit = null, $search = null, $count = false);
    public function getAllTeachersInCamp($camp_id, $limit = null, $search = null, $count = false);
    public function checkCampNameUniqueInSchool(School $school, $campName);
    public function getCampActivity($camp_id, $activity_id, $is_default = true);
    public function getLastOrderInActivityCamp($camp_id);
    public function storeCamp(Camp $camp);
    public function storeSchoolCamp(SchoolCamp $schoolCamp);
    public function storeSchoolCampDistributor(SchoolDistributorCamp $distributorCamp);
    public function storeSchoolCampDetail(SchoolCampDetail $campDetail);
    public function storeCampUser(CampUser $campUser);
    public function getAllStudentsInCamps($school_id, $grade_id = null, $limit = null, $search = null, $count = null);
    public function getAllTeachersInCamps($school_id, $limit = null, $search = null, $count = null);
    public function getAssignedStudentsInCamp($camp_id, $count = null);
    public function checkIfPaidCamp($camp_id);
    public function checkIfEndedCamp($camp_id);
    public function getCampStatus($camp_id);
    public function deleteCampActivity(CampActivity $campActivity);
    public function deleteCampUsers(CampUser $campUser);
    public function getCampUser($camp_id, $userId);
    public function emailCampDistributor($distributor_name, $campName, $students, $activities, $distributor_email, $admin_name, $admin_email, $school_name, $code, $startDate, $endDate, $upgrade = false);
    public function emailCampSchool($account_name, $students, $activities, $startDate, $endDate, $account_email, $upgrade = false);
    public function getInActiveCampsInSchool($school_id, $count = null);
    public function getActiveCampsInSchool($school_id, $count = null, $camp_ids = null);
    public function getAllDefaultActivitiesInCamp($camp_id, $limit = null, $search = null, $count = null);
    public function campsHasProgress($school_id, $camp_ids = null);
    public function deleteCampUser(CampUser $campUser);
    public function storeCampActivity(CampActivity $campActivity);
    public function deleteCampActivities($camp_id);
    public function getActivityTaskOrder($activity_id, $task_id, $is_default = true);
    public function getUserProgressByOrderInActivity($user_id, $order, $camp_id, $activity_id, $is_default);
    public function getLastProgressInCamp($camp_id);
    // activities
    public function getDefaultActivityById($id);
    public function getAllActivities($limit = null, $search = null, $count = null, $is_b2b = null, $is_b2c = null);
    public function checkIfActivityInCamp($camp_id, $activity_id, $is_default = true);

    // teacher in camps
    public function getTeacherCamps($school_id, $teacher_id);
    public function checkIfTeacherInCamp($camp_id, $teacher_id);
    public function checkIfStudentInCamp($camp_id, $student_id);
    public function getRemainingTasksInActivityInCamp($camp_id, $activity_id, $student_id, $count = null, $is_default = true);
    public function getCompletedTasksInActivityInCamp($camp_id, $activity_id, $student_id, $count = null, $is_default = true);
    public function getStudentBlockingTasksInCamp($camp_id, $student_id);
    public function getStudentLastPlayedTaskInCamp($camp_id, $student_id);
    public function getCompletedTasksInCampActivity($camp_id, $activity_id, $is_default = true);
    public function getStudentRunningCamps($student_id, $count = null);
    public function getCampDefaultActivities($camp_id, $limit = null, $search = null, $count = null);
    public function getStudentSolvedActivityInCamp($camp_id, $activity_id, $student_id, $count = null);
    public function checkIfCampInSchool($camp_id, $school_id);
    public function getOrderedStudentsInCamp($camp_id, $limit = null, $search = null, $count = false);

    // game in camp
    public function getUserTaskProgressActivityCamp(Task $task, $user_id, $camp_id, $activity_id, $is_default = true);
    public function storeCampActivityProgress(CampActivityProgress $campActivityProgress);
    public function deleteCampActivityProgress(CampActivityProgress $campActivityProgress);
    public function getLastSolvedTaskInActivity($user_id, $camp_id, $activity_id, $is_default = true);

    public function getLastDistributorSubscription($user_id);

}