<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoreLocation;
use App\Models\CoreSchedule;
use Illuminate\Support\Facades\Auth;

class CoreScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $core_schedule = CoreSchedule::where('data_state', '=', 0)->get();
        return view('content.CoreSchedule.ListCoreSchedule', compact('core_schedule'));
    }

    public function getLocationName($location_id){
        $core_location = CoreLocation::where('data_state', 0)
        ->where('location_id', $location_id)
        ->first();

        if($core_location == null){
            "-";
        }else{
            return $core_location->location_name;
        }
    }

    public function addCoreSchedule()
    {
        $core_location = CoreLocation::where('data_state', '=', 0)->pluck('location_name', 'location_id');
        return view('content.CoreSchedule.AddCoreSchedule', compact('core_location'));
    }

    public function processAddCoreSchedule(Request $request){
        $fields = $request->validate([
            'location_id'             => 'required',
            'schedule_day'            => 'required',
            'schedule_description'    => 'required',
        ]);

        $data = [
            'location_id'             => $fields['location_id'],  
            'schedule_day'            => $fields['schedule_day'],  
            'schedule_description'    => $fields['schedule_description'],  
            'created_id'              => Auth::id(),
            'created_at'              => date('Y-m-d'),
        ];

        if(CoreSchedule::insert($data)){
            $msg = 'Tambah Jadwal Patroli Berhasil';
        }else{
            $msg = 'Tambah  Jadwal Patroli Gagal';
        }

        return redirect('/schedule/add-schedule')->with('msg', $msg);
    }

    public function editCoreSchedule($schedule_id){
        $core_schedule = CoreSchedule::where('data_state', 0)
        ->where('schedule_id', $schedule_id)
        ->first();

        $core_location = CoreLocation::where('data_state', '=', 0)->pluck('location_name', 'location_id');

        return view('content.CoreSchedule.editCoreSchedule', compact('core_schedule', 'core_location'));
    }

    public function processEditCoreSchedule(Request $request){
        $fields = $request->validate([
            'schedule_id'             => 'required',
            'location_id'             => 'required',
            'schedule_day'            => 'required',
            'schedule_description'    => 'required',
        ]);

        $data = CoreSchedule::findOrFail($fields['schedule_id'])
        ->update([
            'location_id'             => $fields['location_id'],  
            'schedule_day'            => $fields['schedule_day'],  
            'schedule_description'    => $fields['schedule_description'],  
        ]);

        if($data){
            $msg = 'Edit Jadwal Patroli Berhasil';
        }else{
            $msg = 'Edit Jadwal Patroli Gagal';
        }
        return redirect('/schedule')->with('msg', $msg);
    }

    public function deleteCoreSchedule($schedule_id){
        $data = CoreSchedule::findOrFail($schedule_id)->update(['data_state' => 1]);
        // $personnels->deleted_id = Auth::id();
        // $data->data_state = 1;

        if ($data) {
            $msg = 'Hapus Jadwal Patroli Berhasil';
        } else {
            $msg = 'Hapus Jadwal Patroli Gagal';
        }

        return redirect('/schedule')->with('msg', $msg);

    }


}
