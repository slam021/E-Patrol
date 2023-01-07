<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataPersonnelRequest;
use App\Models\CorePersonnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorePersonnelController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('content/CorePersonnel/ListCorePersonnel', [
            'corepersonnel' => CorePersonnel::where('data_state', '=', 0)->get(),
        ]);
    }

    public function detailCorePersonnel($personnel_id){

        $corepersonnel = CorePersonnel::where('data_state', '=', 0)
        ->where('core_personnel.personnel_id', $personnel_id)
        ->first();

        // dd($corepersonnel);

        return view('content.CorePersonnel.DetailCorePersonnel', compact('corepersonnel'));
    }

    public function addCorePersonnel(Request $request){
        $corepersonnel = CorePersonnel::where('data_state', '=', 0)->get();
        return view('content.CorePersonnel.AddCorePersonnel', compact('corepersonnel'));
    }

    public function processAddCorePersonnel(Request $request){

        // dd($request->all());
        $fields = $request->validate([
            'personnel_full_name'             => 'required',
            'personnel_nick_name'             => 'required',
            'personnel_nik'                   => 'required',
            'personnel_gender'                => 'required',
            'personnel_address'               => 'required',
            'personnel_birth_place'           => 'required',
            'personnel_birth_date'            => 'required',
            'personnel_phone'                 => 'required',
            'personnel_phone_family'          => 'required',
        ]);

        $data = array([
            'personnel_full_name'             => $fields['personnel_full_name'],
            'personnel_nick_name'             => $fields['personnel_nick_name'],
            'personnel_nik'                   => $fields['personnel_nik'],
            'personnel_gender'                => $fields['personnel_gender'],
            'personnel_address'               => $fields['personnel_address'],
            'personnel_birth_place'           => $fields['personnel_birth_place'],
            'personnel_birth_date'            => $fields['personnel_birth_date'],
            'personnel_phone'                 => $fields['personnel_phone'],
            'personnel_phone_family'          => $fields['personnel_phone_family'],
            'created_id'                      => Auth::id(),
            'created_at'                      => date('Y-m-d'),

        ]);

        // dd($data);
        if(CorePersonnel::insert($data)){
            $msg = 'Tambah Data Personil Berhasil';
            return redirect('/personnel')->with('msg', $msg);
        }else{
            $msg = 'Tambah Data Personil Gagal';
            return redirect('/personnel')->with('msg', $msg);
        }
    }

    public function editCorePersonnel($personnel_id)
    {
        $corepersonnel = CorePersonnel::where('personnel_id', $personnel_id)->first();
        // dd($corepersonnel);
        return view('content.CorePersonnel.EditCorePersonnel', compact('corepersonnel'));
    }

    public function processEditCorePersonnel(Request $request){

        $fields = $request->validate([
            'personnel_id'                    => 'required',
            'personnel_full_name'             => 'required',
            'personnel_nick_name'             => 'required',
            'personnel_nik'                   => 'required',
            'personnel_gender'                => 'required',
            'personnel_address'               => 'required',
            'personnel_birth_place'           => 'required',
            'personnel_birth_date'            => 'required',
            'personnel_phone'                 => 'required',
            'personnel_phone_family'          => 'required',
        ]);

        // dd($data);
        $data = CorePersonnel::find($fields['personnel_id'])
        ->update([ 
            'personnel_full_name'             => $fields['personnel_full_name'],
            'personnel_nick_name'             => $fields['personnel_nick_name'],
            'personnel_nik'                   => $fields['personnel_nik'],
            'personnel_gender'                => $fields['personnel_gender'],
            'personnel_address'               => $fields['personnel_address'],
            'personnel_birth_place'           => $fields['personnel_birth_place'],
            'personnel_birth_date'            => $fields['personnel_birth_date'],
            'personnel_phone'                 => $fields['personnel_phone'],
            'personnel_phone_family'          => $fields['personnel_phone_family']
        ]);
        
        if($data){
            $msg = 'Tambah Data Personil Berhasil';
            return redirect('/personnel')->with('msg', $msg);
        }else{
            $msg = 'Tambah Data Personil Gagal';
            return redirect('/personnel')->with('msg', $msg);
        }
    }

    public function deleteCorePersonnel($personnel_id)
    {
        $item = CorePersonnel::findOrFail($personnel_id)->update(['data_state' => 1]);
        // $personnels->deleted_id = Auth::id();
        // $item->data_state = 1;

        if ($item) {
            $msg = 'Hapus Data Personil Berhasil';
        } else {
            $msg = 'Hapus Data Personil Gagal';
        }

        return redirect('/personnel')->with('msg', $msg);
    }
}
