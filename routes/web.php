<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\SystemUserController;
use App\Http\Controllers\SystemUserGroupController;
use App\Http\Controllers\CorePersonnelController;
use App\Http\Controllers\DataAdministratorController;
use App\Http\Controllers\CorePatrolController;
use App\Http\Controllers\CorePatrolReportController;
use App\Http\Controllers\CorePatrolItemController;
use App\Http\Controllers\CorePatrolLocationController;
use App\Http\Controllers\CorePatrolScheduleController;
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
Route::get('/data-admin', [DataAdministratorController::class, 'index'])->name('data-admin');
Route::get('/data-admin/view-admin', [DataAdministratorController::class, 'viewAdmin'])->name('view-admin');
Route::get('/data-admin/create-admin', [DataAdministratorController::class, 'createAdmin'])->name('create-admin');
Route::post('/data-admin/store-admin', [DataAdministratorController::class, 'storeAdmin'])->name('store-admin');
Route::get('/data-admin/edit-admin/{id}', [DataAdministratorController::class, 'editAdmin'])->name('edit-admin');
Route::put('/data-admin/{id}', [DataAdministratorController::class, 'updateAdmin'])->name('update-admin');
Route::get('/data-admin/delete-admin/{id}', [DataAdministratorController::class, 'deleteAdmin'])->name('delete-admin');

//====================================================================================================================================================//
Route::get('/desc-patrol', [CorePatrolController::class, 'index'])->name('desc-patrol');
Route::get('/desc-patrol/create-desc-patrol', [CorePatrolController::class, 'createCorePatrol'])->name('create-desc-patrol');
Route::post('/desc-patrol/store-desc-patrol', [CorePatrolController::class, 'storeCorePatrol'])->name('store-desc-patrol');
Route::get('/desc-patrol/edit-desc-patrol/{id}', [CorePatrolController::class, 'editCorePatrol'])->name('edit-desc-patrol');
Route::put('/desc-patrol/{id}', [CorePatrolController::class, 'updateCorePatrol'])->name('update-desc-patrol');
Route::get('/desc-patrol/delete-desc-patrol/{id}', [CorePatrolController::class, 'deleteCorePatrol'])->name('delete-desc-patrol');

//====================================================================================================================================================//
Route::get('/patrol-location', [CorePatrolLocationController::class, 'index'])->name('patrol-location');
Route::get('/patrol-location/create-patrol-location', [CorePatrolLocationController::class, 'createCorePatrolLocation'])->name('create-patrol-location');
Route::post('/patrol-location/store-patrol-location', [CorePatrolLocationController::class, 'storeCorePatrolLocation'])->name('store-patrol-location');
Route::get('/patrol-location/edit-patrol-location/{id}', [CorePatrolLocationController::class, 'editCorePatrolLocation'])->name('edit-patrol-location');
Route::put('/patrol-location/{id}', [CorePatrolLocationController::class, 'updateCorePatrolLocation'])->name('update-patrol-location');
Route::get('/patrol-location/delete-patrol-location/{id}', [CorePatrolLocationController::class, 'deleteCorePatrolLocation'])->name('delete-patrol-location');
Route::get('/patrol-location/print-qr/{patrol_location_id}', [CorePatrolLocationController::class, 'printQR'])->name('print-qr');
Route::get('/patrol-location/print-all-qr/{patrol_id}', [CorePatrolLocationController::class, 'printAllQR'])->name('print-all-qr');

//====================================================================================================================================================//
Route::get('/patrol-schedule', [CorePatrolScheduleController::class, 'index'])->name('patrol-schedule');
Route::get('/patrol-schedule/create-reset', [CorePatrolScheduleController::class, 'createReset'])->name('create-reset');
Route::post('/patrol-schedule/create-patrol-schedule-ajax', [CorePatrolScheduleController::class, 'createPatrolScheduleAjax'])->name('create-patrol-schedule-ajax');
Route::get('/patrol-schedule/delete-patrol-schedule-ajax/{record_id}', [CorePatrolScheduleController::class, 'deletePatrolScheduleAjax'])->name('delete-patrol-schedule-ajax');
Route::post('/patrol-schedule/create-patrol-element-ajax', [CorePatrolScheduleController::class, 'createPatrolElementAjax'])->name('create-patrol-element-ajax');

Route::post('/patrol-schedule/edit-patrol-schedule-ajax', [CorePatrolScheduleController::class, 'editPatrolScheduleAjax'])->name('edit-patrol-schedule-ajax');
Route::post('/patrol-schedule/edit-patrol-elemet-ajax', [CorePatrolScheduleController::class, 'editPatrolElementAjax'])->name('edit-patrol-element-ajax');
Route::get('/patrol-schedule/edit-reset/{patrol_id}', [CorePatrolScheduleController::class, 'editReset'])->name('edit-reset');
Route::get('/patrol-schedule/delete-edit-patrol-ajax/{record_id}/{patrol_id}', [CorePatrolScheduleController::class, 'deleteEditPatrolAjax'])->name('delete-edit-patrol-ajax');

Route::get('/patrol-schedule/create-patrol-schedule', [CorePatrolScheduleController::class, 'createPatrolSchedule'])->name('create-patrol-schedule');
Route::post('/patrol-schedule/store-patrol-schedule', [CorePatrolScheduleController::class, 'storePatrolSchedule'])->name('store-patrol-schedule');
Route::get('/patrol-schedule/edit-patrol-schedule/{patrol_id}', [CorePatrolScheduleController::class, 'editPatrolSchedule'])->name('edit-patrol-schedule');
Route::post('/patrol-schedule/update-patrol-schedule', [CorePatrolScheduleController::class, 'updatePatrolSchedule'])->name('update-patrol-schedule');
Route::get('/patrol-schedule/delete-patrol-schedule/{patrol_id}', [CorePatrolScheduleController::class, 'deletePatrolSchedule'])->name('delete-patrol-schedule');

Route::match(['get', 'post'], '/patrol-schedule/personnel-scheduling/{patrol_id}', [CorePatrolScheduleController::class, 'personnelScheduling'])->name('personnel-scheduling');
Route::get('/patrol-schedule/personnel-scheduling-ajax', [CorePatrolScheduleController::class, 'personnelSchedulingAjax'])->name('personnel-scheduling-ajax');
Route::match(['get', 'post'], '/patrol-schedule/store-personnel-scheduling', [CorePatrolScheduleController::class, 'storePersonnelScheduling'])->name('store-personnel-scheduling');
Route::get('/patrol-schedule/delete-personnel-scheduling/{scheduling_id}', [CorePatrolScheduleController::class, 'deletePersonnelScheduling'])->name('delete-personnel-scheduling');

Route::match(['get', 'post'], '/patrol-schedule/patrol-task/{patrol_id}', [CorePatrolScheduleController::class, 'patrolTask'])->name('patrol-task');
Route::get('/patrol-schedule/patrol-task-ajax', [CorePatrolScheduleController::class, 'patrolTaskAjax'])->name('patrol-task-ajax');
Route::match(['get', 'post'], '/patrol-schedule/store-patrol-task', [CorePatrolScheduleController::class, 'storePatrolTask'])->name('store-patrol-task');
Route::get('/patrol-schedule/delete-patrol-task/{task_id}', [CorePatrolScheduleController::class, 'deletePatrolTask'])->name('delete-patrol-task');

Route::match(['get', 'post'], '/patrol-schedule/view-patrol-item/{patrol_id}', [CorePatrolScheduleController::class, 'viewPatrolItem'])->name('view-patrol-item');

//====================================================================================================================================================//
Route::get('/patrol-report', [CorePatrolReportController::class, 'indexReport'])->name('patrol-report');
Route::get('/patrol-report/patrol-report-task/{patrol_report_id}', [CorePatrolReportController::class, 'indexReportTask'])->name('patrol-report-task');
Route::match(['get', 'post'], '/patrol-report/upload', [CorePatrolReportController::class, 'upload'])->name('upload');

//====================================================================================================================================================//
Route::get('/personnel-precense', [CorePersonnelPresenceController::class, 'index'])->name('personnel-precense');

// Route::get('/personnel-scheduling/view-personnel-scheduling/{id}', [CorePersonnelSchedulingController::class, 'viewPersonnelScheduling'])->name('view-personnel-scheduling');
