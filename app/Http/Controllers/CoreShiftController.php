<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoreShift;
use Illuminate\Support\Facades\Auth;


class CoreShiftController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $core_shift = CoreShift::where('data_state', '=', 0)->get();
        return view('content.CoreShift.ListCoreShift', compact('core_shift'));
    }

    public function addCoreShift()
    {
        return view('content.CoreShift.AddCoreShift');
    }

    public function processAddCoreShift(Request $request){
        $fields = $request->validate([
            'shift_name'              => 'required',
            'shift_start_hours'       => 'required',
            'shift_end_hours'         => 'required',
        ]);

        $data = [
            'shift_name'              => $fields['shift_name'],  
            'shift_start_hours'       => $fields['shift_start_hours'],  
            'shift_end_hours'         => $fields['shift_end_hours'],  
            'created_id'              => Auth::id(),
            'created_at'              => date('Y-m-d'),
        ];

        if(CoreShift::insert($data)){
            $msg = 'Tambah Data Shift Berhasil';
        }else{
            $msg = 'Tambah  Data Shift Gagal';
        }

        return redirect('/shift/add-shift')->with('msg', $msg);
    }

    public function editCoreShift($shift_id){
        $core_shift = CoreShift::where('data_state', 0)
        ->where('shift_id', $shift_id)
        ->first();

        return view('content.CoreShift.editCoreShift', compact('core_shift'));
    }

    public function processEditCoreShift(Request $request){
        $fields = $request->validate([
            'shift_id'             => 'required',
            'shift_name'              => 'required',
            'shift_start_hours'       => 'required',
            'shift_end_hours'         => 'required',
        ]);

        $data = CoreShift::findOrFail($fields['shift_id'])
        ->update([
            'shift_name'             => $fields['shift_name'],  
            'shift_start_hours'      => $fields['shift_start_hours'],  
            'shift_end_hours'        => $fields['shift_end_hours'],  
        ]);

        if($data){
            $msg = 'Edit Data Shift Berhasil';
        }else{
            $msg = 'Edit Data Shift Gagal';
        }
        return redirect('/shift')->with('msg', $msg);
    }

    public function deleteCoreShift($shift_id){
        $data = CoreShift::findOrFail($shift_id)->update(['data_state' => 1]);
        // $personnels->deleted_id = Auth::id();
        // $data->data_state = 1;

        if ($data) {
            $msg = 'Hapus Data Shift Berhasil';
        } else {
            $msg = 'Hapus Data Shift Gagal';
        }

        return redirect('/shift')->with('msg', $msg);

    }
}

