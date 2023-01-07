<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CorePatrol;
use App\Models\CorePatrolItem;
use App\Http\Requests\CorePatrolRequest;
use App\Models\CorePatrolLocation;
use App\Models\CorePatrolTask;
use App\Models\CorePersonnelScheduling;
use App\Models\DataPersonnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Elibyy\TCPDF\Facades\TCPDF;



class CorePatrolScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Session::forget('data_patrol');
        Session::forget('data_patrol_item');
        Session::forget('data_corepatrolitem_first');

        $core_patrolschedule = CorePatrol::where('data_state', '=', 0)->get();
        return view('content/CorePatrolSchedule/ListPatrolSchedule', compact('core_patrolschedule'));
    }

    public function createReset()
    {

        Session::forget('data_patrol');
        Session::forget('data_patrol_item');

        return redirect('/patrol-schedule/create-patrol-schedule');
    }

    public function createPatrolSchedule(Request $request)
    {
        $core_patrol           = Session::get('data_patrol');
        $core_patrol_item      = Session::get('data_patrol_item');
        // print_r($core_patrol);
        // exit();

        $patrol_location_id = Session::get('patrol_location_id');
        $data_location = CorePatrolLocation::where('data_state', 0)->pluck('location_name', 'patrol_location_id');
        return view('content/CorePatrolSchedule/CreatePatrolSchedule', compact('core_patrol', 'core_patrol_item', 'patrol_location_id', 'data_location'));
    }

    public function createPatrolElementAjax(Request $request)
    {

        $data_patrol           = Session::get('data_patrol');

        $data_patrol[$request->name] = $request->value;

        Session::put('data_patrol',  $data_patrol);

        return redirect('/patrol-schedule/create-patrol-schedule');
    }

    public function createPatrolScheduleAjax(Request $request)
    {
        $data_patrol_item = array(
            'record_id'                      => date('YmdHis'),
            'hour'                           => $request->hour,
            'patrol_location_id'             => $request->patrol_location_id,
        );


        $last_data_patrol_item = Session::get('data_patrol_item');
        if ($last_data_patrol_item != null) {
            Session::push('data_patrol_item', $data_patrol_item);
        } else {
            $data_array = [];
            array_push($data_array, $data_patrol_item);
            Session::put('data_patrol_item', $data_array);
        }

        return redirect('/patrol-schedule/create-patrol-schedule');
    }

    public function deletePatrolScheduleAjax($record_id)
    {
        $arrayNew             = array();
        $dataArrayHeader      = Session::get('data_patrol_item');

        foreach ($dataArrayHeader as $key => $val) {
            if ($key != $record_id) {
                $arrayNew[$key] = $val;
            }
        }
        Session::forget('data_patrol_item');
        Session::put('data_patrol_item', $arrayNew);

        return redirect('/patrol-schedule/create-patrol-schedule');
    }

    public function getLocationName($location_name)
    {
        $location = CorePatrolLocation::where('patrol_location_id', $location_name)->first();
        return $location['location_name'];
    }

    public function storePatrolSchedule(Request $request)
    {
        $params = $request->all();
        // print_r($params);
        // exit();
        $request->validate([
            'patrol_name'              => 'required',
            'day'                      => 'required',
            'description'              => 'required',
        ]);

        $store_patrol = CorePatrol::create([
            'patrol_id'                => $request,
            'patrol_name'              => $request->patrol_name,
            'day'                      => $request->day,
            'description'              => $request->description,
            'created_id'               => Auth::id(),

            // 'data_state'               => 0,
            // 'patrol_token'             => $fields['patrol_token'],
            // 'created_on'                 => date('Y-m-d H:i:s'),
        ]);

        $data_location = CorePatrolLocation::where('patrol_location_id', $request->patrol_location_id)->first();

        $corepatrol_last         = CorePatrol::select('patrol_id')
            ->where('created_id', '=', $store_patrol['created_id'])
            ->orderBy('patrol_id', 'DESC')
            ->first();
        if (empty($params['hour'])) {
            $msg = 'Tambah Jadwal Berhasil. Tapi Detail Jadwal Patroli Belum Diisi.';
            return redirect('/patrol-schedule')->with('msg', $msg);
        } else {
            for ($i = 0; $i < count($params['hour']); $i++) {
                $store_patrolitem = CorePatrolItem::create([
                    'patrol_id'             => $corepatrol_last['patrol_id'],
                    'hour'                  => $params['hour'][$i],
                    'patrol_location_id'    => $params['patrol_location_id'][$i],
                    'created_id'            => Auth::id(),
                ]);
            }
            $msg = 'Tambah Jadwal Berhasil';
            return redirect('/patrol-schedule')->with('msg', $msg);
        }
    }


    public function editPatrolSchedule($patrol_id)
    {


        $corepatrol                = CorePatrol::where('patrol_id', $patrol_id)->first();
        $data_corepatrolitem_first = Session::get('data_corepatrolitem_first');

        if ($data_corepatrolitem_first == null) {
            $data_corepatrolitem_first     = [];

            $corepatrolitem  = CorePatrolItem::select('patrol_item_id', 'hour', 'patrol_location_id')
                ->where('patrol_id', '=', $patrol_id)
                ->where('data_state', '=', 0)
                ->get();

            foreach ($corepatrolitem  as $key => $val) {
                $record_id = $val['patrol_item_id'];

                $data_item = array(
                    'record_id'                            => $val['patrol_item_id'],
                    'hour'                                 => $val['hour'],
                    'patrol_location_id'                        => $val['patrol_location_id'],
                    'item_status'                          => 9,
                );


                array_push($data_corepatrolitem_first, $data_item);
                Session::push('data_corepatrolitem_first', $data_item);

                $data_corepatrol_item = Session::get('data_patrol_item');
                if ($data_corepatrol_item !== null) {
                    array_push($data_corepatrol_item, $data_item);
                    Session::put('data_patrol_item', $data_corepatrol_item);
                } else {
                    $data_corepatrol_item = [];
                    array_push($data_corepatrol_item, $data_item);
                    Session::push('data_patrol_item', $data_item);
                }
            }
        }
        // dd($data_corepatrolitem_first);

        $patrol_location_id = Session::get('patrol_location_id');
        $data_location = CorePatrolLocation::where('data_state', 0)->pluck('location_name', 'patrol_location_id');
        $corepatrolitem = Session::get('data_patrol_item');
        return view('content.CorePatrolSchedule.EditPatrolSchedule', compact('corepatrol', 'corepatrolitem', 'patrol_location_id', 'data_location'));
    }

    public function editReset($patrol_id)
    {
        Session::forget('data_patrol_item');
        Session::forget('data_corepatrolitem_first');

        return redirect('/patrol-schedule/edit-patrol-schedule/' . $patrol_id);
    }

    public function editPatrolScheduleAjax(Request $request)
    {
        $patrol_id = $request->patrol_id;

        $data_patrol_item = array(
            'record_id'                      => date('YmdHis'),
            'patrol_id'                      => $request->patrol_id,
            'hour'                           => $request->hour,
            'patrol_location_id'                  => $request->patrol_location_id,
            'item_status'                    => 1,
        );

        $last_data_patrol_item = Session::get('data_patrol_item');
        if ($last_data_patrol_item !== null) {
            array_push($last_data_patrol_item, $data_patrol_item);
            Session::put('data_patrol_item', $last_data_patrol_item);
        } else {
            $last_data_patrol_item = [];
            array_push($last_data_patrol_item, $data_patrol_item);
            Session::push('data_patrol_item', $data_patrol_item);
        }

        return redirect('/patrol-schedule/edit-patrol-schedule/' . $patrol_id);
    }

    public function deleteEditPatrolAjax($record_id, $patrol_id)
    {

        $arrayNew            = array();
        $dataArrayHeader     = Session::get('data_patrol_item');

        foreach ($dataArrayHeader as $key => $val) {
            if ($key == $record_id) {
                $arrayNew[$key]                 = $val;
                $arrayNew[$key]['item_status'] = 2;
            } else {
                $arrayNew[$key]                 = $val;
            }
        }

        Session::forget('data_patrol_item');
        Session::put('data_patrol_item', $arrayNew);

        return redirect('patrol-schedule/edit-patrol-schedule/' . $patrol_id);
    }

    public function updatePatrolSchedule(Request $request)
    {
        $session_patrolitem        = Session::get('data_patrol_item');

        $patrol_id = $request->patrol_id;

        $fields = $request->validate([
            'patrol_id'             => 'required',
            'patrol_name'           => 'required',
            'day'                   => 'required',
            'description'           => 'required',
        ]);

        $item                       = CorePatrol::findOrFail($fields['patrol_id']);
        $item->patrol_name          = $fields['patrol_name'];
        $item->day                  = $fields['day'];
        $item->description          = $fields['description'];
        // $item->updated_id           = Auth::id();

        if (!empty($session_patrolitem)) {
            if ($item->save()) {
                foreach ($session_patrolitem as $key => $val) {
                    if ($val['item_status'] == 1) {
                        $dataitem = array(
                            'patrol_id'                 => $fields['patrol_id'],
                            'hour'                      => $val['hour'],
                            'patrol_location_id'        => $val['patrol_location_id'],
                            'updated_id'                => Auth::id(),
                        );

                        if (CorePatrolItem::create($dataitem)) {
                            $msg = "Edit Jadwal Patroli Berhasil";
                            continue;
                        } else {
                            $msg = "Edit Jadwal Patroli Gagal";
                            return redirect('/patrol-schedule/edit-patrol-schedule/' . $patrol_id)->with('msg', $msg);
                            break;
                        }
                    } else if ($val['item_status'] == 2) {
                        $item                   = CorePatrolItem::findOrFail($val['record_id']);
                        $item->data_state       = 2;

                        if ($item->save()) {
                            $msg = "Edit Jadwal Patroli Berhasil";
                            continue;
                        } else {
                            $msg = "Edit Jadwal Patroli Gagal";
                            return redirect('/patrol-schedule/edit-patrol-schedule/' . $patrol_id)->with('msg', $msg);
                            break;
                        }
                    }
                }
                $msg = "Edit Jadwal Patroli Berhasil";
                Session::forget('data_patrol_item');
                Session::forget('data_corepatrolitem_first');
                return redirect('/patrol-schedule/edit-patrol-schedule/' . $patrol_id)->with('msg', $msg);
            } else {
                $msg = "Edit Jadwal Patroli Gagal";
                return redirect('/patrol-schedule/edit-patrol-schedule/' . $patrol_id)->with('msg', $msg);
            }
        } else {
            $msg = "Edit Jadwal Patroli Berhasil";
            Session::forget('data_patrol_item');
            return redirect('/patrol-schedule/edit-patrol-schedule/' . $patrol_id)->with('msg', $msg);
        }
    }
    // $session_corepatrol_item       = Session::get('data_patrol_item');

    // $fields = $request->validate([
    //     'patrol_name'              => $fields['patrol_name'],
    //     'day'                      => $fields['day'],
    //     'description'              => $fields['description'],
    // ]);

    // $params = $request->all();
    // $corepatrol = CorePatrol::findOrFail($patrol_id);
    // $corepatrol->update($params);
    // // $corepatrol = CorePatrol::where('patrol_id', $patrol_id)->update([
    // //     'patrol_id'                => $request,
    // //     'patrol_name'              => $request->patrol_name,
    // //     'day'                      => $request->day,
    // //     'description'              => $request->description,
    // // ]);

    // // 
    // $corepatrol_last         = CorePatrol::select('patrol_id')
    //     ->where('patrol_id', '=', $corepatrol['patrol_id'])
    //     ->orderBy('patrol_id', 'DESC')
    //     ->first();

    // CorePatrolItem::where('patrol_id', $patrol_id)->delete();
    // for ($i = 0; $i <br count($params['hour']); $i++) {
    //     CorePatrolItem::with('patrol_id', $patrol_id)->create([
    //         'patrol_id'             => $corepatrol_last['patrol_id'],
    //         'hour'                  => $params['hour'][$i],
    //         'longtitude'            => $params['longtitude'][$i],
    //         'latitude'              => $params['latitude'][$i],
    //         'item_status'           => 1,
    //     ]);
    // }
    // $msg = 'Ubah Jadwal Berhasil';
    // return redirect('/patrol-schedule')->with('msg', $msg);

    public function personnelScheduling($patrol_id)
    {
        $corepatrol                = CorePatrol::where('patrol_id', $patrol_id)->first();
        $data_corepatrolitem_first = Session::get('data_corepatrolitem_first');

        if ($data_corepatrolitem_first == null) {
            $data_corepatrolitem_first     = [];

            $corepatrolitem  = CorePatrolItem::select('patrol_item_id', 'hour', 'patrol_location_id')
                ->where('patrol_id', '=', $patrol_id)
                ->where('data_state', '=', 0)
                ->get();

            foreach ($corepatrolitem  as $key => $val) {
                $record_id = $val['patrol_item_id'];

                $data_item = array(
                    'patrol_item_id'                       => $val['patrol_item_id'],
                    'hour'                                 => $val['hour'],
                    'patrol_location_id'                   => $val['patrol_location_id'],
                    'item_status'                          => 9,
                );


                array_push($data_corepatrolitem_first, $data_item);
                Session::push('data_corepatrolitem_first', $data_item);

                $data_corepatrol_item = Session::get('data_patrol_item');
                if ($data_corepatrol_item !== null) {
                    array_push($data_corepatrol_item, $data_item);
                    Session::put('data_patrol_item', $data_corepatrol_item);
                } else {
                    $data_corepatrol_item = [];
                    array_push($data_corepatrol_item, $data_item);
                    Session::push('data_patrol_item', $data_item);
                }
            }
        }

        $personnel_id = Session::get('personnel_id');
        $scheduling = CorePersonnelScheduling::where('data_state', 0)->get();
        $datapersonnel = DataPersonnel::where('data_state', 0)->pluck('full_name', 'personnel_id', 'phone_number');

        $corepatrolitem = Session::get('data_patrol_item');
        return view('content.CorePatrolSchedule.PersonnelScheduling', compact('corepatrol', 'corepatrolitem', 'datapersonnel', 'personnel_id', 'scheduling'));
    }

    public function storePersonnelScheduling(Request $request)
    {
        // dd($request->all());
        $patrol_id = $request->patrol_id;
        $data_user = DataPersonnel::where('personnel_id', $request->personnel_id)->first();

        $scheduling_last = CorePersonnelScheduling::where([
            'patrol_item_id' => $request->patrol_item_id,
            'personnel_id'   => $request->personnel_id,
            'data_state'     => 0,
        ])->first();
        // $scheduling_last = CorePersonnelScheduling::where('patrol_item_id', 'personnel_id')->get();
        // $scheduling_last = CorePersonnelScheduling::where('data_state', 0)->get();
        // dd($scheduling_last);
        if ($scheduling_last) {
            $msg_err = 'Data Sudah Ada!';
            return redirect('/patrol-schedule/personnel-scheduling/' . $patrol_id)->with('msg_err', $msg_err);
        } else {
            $storescheduling = CorePersonnelScheduling::create([
                'scheduling_id'              => $request->scheduling_id,
                'patrol_item_id'             => $request->patrol_item_id,
                'personnel_id'               => $request->personnel_id,
                'full_name'                  => $data_user['full_name'],
                'phone_number'               => $data_user['phone_number'],
                'created_id'                 => Auth::id(),


            ]);

            $msg = 'Tambah Penjadwalan Personil Berhasil';
            return redirect('/patrol-schedule/personnel-scheduling/' . $patrol_id)->with('msg', $msg);
        }
    }

    public function deletePersonnelScheduling($scheduling_id)
    {

        $item = CorePersonnelScheduling::findOrFail($scheduling_id);
        $item->deleted_id = Auth::id();
        $item->data_state = 1;
        if ($item->save()) {
            $msg = 'Hapus Penjadwal Personil Berhasil';
        } else {
            $msg = 'Hapus Penjadwal Personil Gagal';
        }

        return redirect()->back()->with('msg', $msg);
    }

    public function patrolTask($patrol_id)
    {
        $corepatrol                = CorePatrol::where('patrol_id', $patrol_id)->first();
        $data_corepatrolitem_first = Session::get('data_corepatrolitem_first');

        if ($data_corepatrolitem_first == null) {
            $data_corepatrolitem_first     = [];

            $corepatrolitem  = CorePatrolItem::select('patrol_item_id', 'hour', 'patrol_location_id')
                ->where('patrol_id', '=', $patrol_id)
                ->where('data_state', '=', 0)
                ->get();

            foreach ($corepatrolitem  as $key => $val) {
                $record_id = $val['patrol_item_id'];

                $data_item = array(
                    'patrol_item_id'                       => $val['patrol_item_id'],
                    'hour'                                 => $val['hour'],
                    'patrol_location_id'                   => $val['patrol_location_id'],
                    'item_status'                          => 9,
                );


                array_push($data_corepatrolitem_first, $data_item);
                Session::push('data_corepatrolitem_first', $data_item);

                $data_corepatrol_item = Session::get('data_patrol_item');
                if ($data_corepatrol_item !== null) {
                    array_push($data_corepatrol_item, $data_item);
                    Session::put('data_patrol_item', $data_corepatrol_item);
                } else {
                    $data_corepatrol_item = [];
                    array_push($data_corepatrol_item, $data_item);
                    Session::push('data_patrol_item', $data_item);
                }
            }
        }

        $patroltask = CorePatrolTask::where('data_state', 0)->get();
        // dd($patroltask);
        $corepatrolitem = Session::get('data_patrol_item');
        return view('content.CorePatrolSchedule.PatrolTask', compact('corepatrol', 'corepatrolitem', 'patroltask'));
    }

    public function storePatrolTask(Request $request)
    {
        // dd($request->all());
        $patrol_id = $request->patrol_id;
        $request->validate([
            'task'                           => 'required|string|max:100',
        ]);

        if (empty($request->task)) {
            $msg = 'Tambah Penugasan Personil Berhasil';
            return redirect()->back()->with('msg', $msg);
        } else {
            $storepatroltask = CorePatrolTask::create([
                'task_id'                    => $request->task_id,
                'patrol_item_id'             => $request->patrol_item_id,
                'task'                       => $request->task,
                'created_id'                 => Auth::id(),


            ]);
        }
    }

    public function deletePatrolTask($task_id)
    {

        $item = CorePatrolTask::findOrFail($task_id);
        $item->deleted_id = Auth::id();
        $item->data_state = 1;
        if ($item->save()) {
            $msg = 'Hapus Penugasan Jadwal Personil Berhasil';
        } else {
            $msg = 'Hapus Penugasan Jadwal Personil Gagal';
        }

        return redirect()->back()->with('msg', $msg);
    }

    public function deletePatrolSchedule($patrol_id)
    {
        $item = CorePatrol::findOrFail($patrol_id);
        $item->deleted_id = Auth::id();
        $item->data_state = 1;
        if ($item->save()) {
            $msg = 'Hapus Jadwal Berhasil';
        } else {
            $msg = 'Hapus Jadwal Gagal';
        }

        return redirect('/patrol-schedule')->with('msg', $msg);
    }
}
