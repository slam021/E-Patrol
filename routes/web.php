<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\SystemUserGroupController;
use App\Http\Controllers\CorePersonnelController;
use App\Http\Controllers\CoreShiftController;
use App\Http\Controllers\CorePatrolController;
use App\Http\Controllers\CorePatrolReportController;
use App\Http\Controllers\CorePatrolItemController;
use App\Http\Controllers\CoreLocationController;
use App\Http\Controllers\CoreScheduleController;
use App\Http\Controllers\CorePersonnelPresenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/system-user', [SystemUserController::class, 'index'])->name('system-user');
Route::get('/system-user/add', [SystemUserController::class, 'addSystemUser'])->name('add-system-user');
Route::post('/system-user/process-add-system-user', [SystemUserController::class, 'processAddSystemUser'])->name('process-add-system-user');
Route::get('/system-user/edit/{user_id}', [SystemUserController::class, 'editSystemUser'])->name('edit-system-user');
Route::post('/system-user/process-edit-system-user', [SystemUserController::class, 'processEditSystemUser'])->name('process-edit-system-user');
Route::get('/system-user/delete-system-user/{user_id}', [SystemUserController::class, 'deleteSystemUser'])->name('delete-system-user');


Route::get('/system-user-group', [SystemUserGroupController::class, 'index'])->name('system-user-group');
Route::get('/system-user-group/add', [SystemUserGroupController::class, 'addSystemUserGroup'])->name('add-system-user-group');
Route::post('/system-user-group/process-add-system-user-group', [SystemUserGroupController::class, 'processAddSystemUserGroup'])->name('process-add-system-user-group');
Route::get('/system-user-group/edit/{user_id}', [SystemUserGroupController::class, 'editSystemUserGroup'])->name('edit-system-user-group');
Route::post('/system-user-group/process-edit-system-user-group', [SystemUserGroupController::class, 'processEditSystemUserGroup'])->name('process-edit-system-user-group');
Route::get('/system-user-group/delete-system-user-group/{user_id}', [SystemUserGroupController::class, 'deleteSystemUserGroup'])->name('delete-system-user-group');

//====================================================================================================================================================//
Route::get('/personnel', [CorePersonnelController::class, 'index'])->name('personnel');
Route::get('/personnel/add-personnel', [CorePersonnelController::class, 'addCorePersonnel'])->name('add-personnel');
Route::post('/personnel/process-add-personnel', [CorePersonnelController::class, 'processAddCorePersonnel'])->name('process-add-personnel');
Route::get('/personnel/detail/{personnel_id}', [CorePersonnelController::class, 'detailCorePersonnel'])->name('detail-personnel');
Route::get('/personnel/edit-personnel/{personnel_id}', [CorePersonnelController::class, 'editCorePersonnel'])->name('edit-personnel');
Route::post('/personnel/process-edit-personnel', [CorePersonnelController::class, 'processEditCorePersonnel'])->name('process-edit-personnel');
Route::get('/personnel/delete-personnel/{personnel_id}', [CorePersonnelController::class, 'deleteCorePersonnel'])->name('delete-personnel');

//====================================================================================================================================================//
// Route::get('/data-admin', [DataAdministratorController::class, 'index'])->name('data-admin');
// Route::get('/data-admin/view-admin', [DataAdministratorController::class, 'viewAdmin'])->name('view-admin');
// Route::get('/data-admin/create-admin', [DataAdministratorController::class, 'createAdmin'])->name('create-admin');
// Route::post('/data-admin/store-admin', [DataAdministratorController::class, 'storeAdmin'])->name('store-admin');
// Route::get('/data-admin/edit-admin/{id}', [DataAdministratorController::class, 'editAdmin'])->name('edit-admin');
// Route::put('/data-admin/{id}', [DataAdministratorController::class, 'updateAdmin'])->name('update-admin');
// Route::get('/data-admin/delete-admin/{id}', [DataAdministratorController::class, 'deleteAdmin'])->name('delete-admin');

//====================================================================================================================================================//
// Route::get('/desc-patrol', [CorePatrolController::class, 'index'])->name('desc-patrol');
// Route::get('/desc-patrol/create-desc-patrol', [CorePatrolController::class, 'createCorePatrol'])->name('create-desc-patrol');
// Route::post('/desc-patrol/store-desc-patrol', [CorePatrolController::class, 'storeCorePatrol'])->name('store-desc-patrol');
// Route::get('/desc-patrol/edit-desc-patrol/{id}', [CorePatrolController::class, 'editCorePatrol'])->name('edit-desc-patrol');
// Route::put('/desc-patrol/{id}', [CorePatrolController::class, 'updateCorePatrol'])->name('update-desc-patrol');
// Route::get('/desc-patrol/delete-desc-patrol/{id}', [CorePatrolController::class, 'deleteCorePatrol'])->name('delete-desc-patrol');

//=============================CoreLocation================================//
Route::get('/location', [CoreLocationController::class, 'index'])->name('location');
Route::get('/location/add-location', [CoreLocationController::class, 'addCoreLocation'])->name('add-location');
Route::post('/location/process-add-location', [CoreLocationController::class, 'processAddCoreLocation'])->name('process-add-location');
Route::get('/location/edit-location/{location_id}', [CoreLocationController::class, 'editCoreLocation'])->name('edit-location');
Route::post('/location/process-edit-location', [CoreLocationController::class, 'processEditCoreLocation'])->name('process-add-location');
Route::get('/location/delete-location/{location_id}', [CoreLocationController::class, 'deleteCoreLocation'])->name('delete-location');
Route::get('/location/print-qr/{location_id}', [CoreLocationController::class, 'printQR'])->name('print-qr');
Route::get('/location/print-all-qr/{location_id}', [CoreLocationController::class, 'printAllQR'])->name('print-all-qr');

//============================CoreSchedule=============================//
Route::get('/schedule', [CoreScheduleController::class, 'index']);
Route::get('/schedule/add-schedule', [CoreScheduleController::class, 'addCoreSchedule'])->name('add-schedule');
Route::post('/schedule/process-add-schedule', [CoreScheduleController::class, 'processAddCoreSchedule'])->name('process-add-schedule');
Route::get('/schedule/edit-schedule/{schedule_id}', [CoreScheduleController::class, 'editCoreSchedule'])->name('edit-schedule');
Route::post('/schedule/process-edit-schedule', [CoreScheduleController::class, 'processEditCoreSchedule'])->name('process-edit-schedule');
Route::get('/schedule/delete-schedule/{schedule_id}', [CoreScheduleController::class, 'deleteCoreSchedule'])->name('delete-schedule');

//==================Core Shift==================//
Route::get('/shift', [CoreShiftController::class, 'index']);
Route::get('/shift/add-shift', [CoreShiftController::class, 'addCoreShift'])->name('add-shift');
Route::post('/shift/process-add-shift', [CoreShiftController::class, 'processAddCoreShift'])->name('process-add-shift');
Route::get('/shift/edit-shift/{shift_id}', [CoreShiftController::class, 'editCoreShift'])->name('edit-shift');
Route::post('/shift/process-edit-shift', [CoreShiftController::class, 'processEditCoreShift'])->name('process-edit-shift');
Route::get('/shift/delete-shift/{shift_id}', [CoreShiftController::class, 'deleteCoreShift'])->name('delete-shift');

Route::match(['get', 'post'], '/schedule/personnel-scheduling/{patrol_id}', [CoreScheduleController::class, 'personnelScheduling'])->name('personnel-scheduling');
Route::get('/schedule/personnel-scheduling-ajax', [CoreScheduleController::class, 'personnelSchedulingAjax'])->name('personnel-scheduling-ajax');
Route::match(['get', 'post'], '/schedule/store-personnel-scheduling', [CoreScheduleController::class, 'storePersonnelScheduling'])->name('store-personnel-scheduling');
Route::get('/schedule/delete-personnel-scheduling/{scheduling_id}', [CoreScheduleController::class, 'deletePersonnelScheduling'])->name('delete-personnel-scheduling');

Route::match(['get', 'post'], '/schedule/task/{patrol_id}', [CoreScheduleController::class, 'patrolTask'])->name('task');
Route::get('/schedule/task-ajax', [CoreScheduleController::class, 'patrolTaskAjax'])->name('task-ajax');
Route::match(['get', 'post'], '/schedule/store-task', [CoreScheduleController::class, 'storePatrolTask'])->name('store-task');
Route::get('/schedule/delete-task/{task_id}', [CoreScheduleController::class, 'deletePatrolTask'])->name('delete-task');

Route::match(['get', 'post'], '/schedule/view-item/{patrol_id}', [CoreScheduleController::class, 'viewPatrolItem'])->name('view-item');

//====================================================================================================================================================//
Route::get('/report', [CorePatrolReportController::class, 'indexReport'])->name('report');
Route::get('/report/report-task/{patrol_report_id}', [CorePatrolReportController::class, 'indexReportTask'])->name('report-task');
Route::match(['get', 'post'], '/report/upload', [CorePatrolReportController::class, 'upload'])->name('upload');

//====================================================================================================================================================//
Route::get('/personnel-precense', [CorePersonnelPresenceController::class, 'index'])->name('personnel-precense');

// Route::get('/personnel-scheduling/view-personnel-scheduling/{id}', [CorePersonnelSchedulingController::class, 'viewPersonnelScheduling'])->name('view-personnel-scheduling');
