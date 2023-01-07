<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CorePatrol;
use App\Http\Requests\CorePatrolRequest;
use Illuminate\Http\Request;

class CorePatrolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('content/CorePatrol/ListPatrol', [
            'patrols' => CorePatrol::where('data_state', '=', 0)->get(),
        ]);
    }

    public function createCorePatrol(Request $request)
    {
        $createpatrols = CorePatrol::where('data_state', '=', 0)->get();
        return view('content.CorePatrol.CreatePatrol', compact('createpatrols'));
    }

    public function storeCorePatrol(CorePatrolRequest $request)
    {
        // $request->validate([
        //     'full_name' => 'required|string',
        // ]);
        $storepatrols = CorePatrol::create([
            'patrol_name'               => $request->patrol_name,
            'day'                       => $request->day,
            'description'               => $request->description,
        ]);
        $msg = 'Tambah Deskripsi Tugas Patroli Berhasil';
        return redirect('/desc-patrol/create-desc-patrol')->with('msg', $msg);
    }

    public function editCorePatrol($id)
    {
        $editpatrols = CorePatrol::where('patrol_id', $id)->first();
        //dd($editpatrols);
        return view('content.CorePatrol.EditPatrol', compact('editpatrols'));
    }

    public function updateCorePatrol(CorePatrolRequest $request, $id)
    {

        $updatepatrols = CorePatrol::where('patrol_id', $id)->update([
            'patrol_name'               => $request->patrol_name,
            'day'                       => $request->day,
            'description'               => $request->description,
        ]);

        $msg = 'Edit Data Personil Berhasil';
        return redirect('/desc-patrol')->with('msg', $msg);
    }

    public function deleteCorePatrol($patrol_id)
    {
        $patrols = CorePatrol::findOrFail($patrol_id);
        $patrols->data_state = 1;

        if ($patrols->save()) {
            $msg = 'Hapus Deskripsi Tugas Patrol Berhasil';
        } else {
            $msg = 'Hapus Deskripsi Tugas Patrol Gagal';
        }
        // $patrols = CorePatrol::where('patrol_id', $id)->delete();
        // $msg = 'Deskripsi Tugas Patrol berhasil Dihapus';
        return redirect('/desc-patrol')->with('msg', $msg);
    }
}
