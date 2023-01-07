<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CorePatrolItem;
use App\Http\Requests\CorePatrolItemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CorePatrolItemController extends Controller
{
    public function index()
    {
        return view('content/CorePatrolItem/ListPatrolItem', [
            'patrolitems' => CorePatrolItem::where('data_state', '=', 0)
                ->get(),
        ]);
    }

    public function createCorePatrolItem(Request $request)
    {
        $createpatrolitems = CorePatrolItem::where('data_state', '=', 0)->get();
        return view('content.CorePatrolItem.CreatePatrolItem', compact('createpatrolitems'));
    }

    public function storeCorePatrolItem(CorePatrolItemRequest $request)
    {
        // $request->validate([
        //     'full_name' => 'required|string',
        // ]);

        $storepatrolitems = CorePatrolItem::create([
            'hour'                  => $request->hour,
            'longtitude'            => $request->longtitude,
            'latitude'              => $request->latitude,
            'create_id'             => Auth::id(),
        ]);
        $msg = 'Tambah Titik Koordinat & Waktu Patroli Berhasil';
        return redirect('/patrol-item/create-patrol-item')->with('msg', $msg);
    }

    public function editCorePatrolItem($id)
    {
        $editpatrolitems = CorePatrolItem::where('patrol_item_id', $id)->first();
        //dd($editpatrols);
        return view('content.CorePatrolItem.EditPatrolItem', compact('editpatrolitems'));
    }

    public function updateCorePatrolItem(CorePatrolItemRequest $request, $id)
    {

        $updatepatrols = CorePatrolItem::where('patrol_item_id', $id)->update([
            'hour'                  => $request->hour,
            'longtitude'            => $request->longtitude,
            'latitude'              => $request->latitude,
        ]);

        $msg = 'Titik Koordinat & Waktu Patroli';
        return redirect('/patrol-item')->with('msg', $msg);
    }

    public function deleteCorePatrolItem($id)
    {
        $patrolitems = CorePatrolItem::findOrFail($id);
        $patrolitems->data_state = 1;

        if ($patrolitems->save()) {
            $msg = 'Titik Koordinat & Waktu Patroli';
        } else {
            $msg = 'Titik Koordinat & Waktu Patroli';
        }
        // $patrols = CorePatrol::where('patrol_id', $id)->delete();
        // $msg = 'Deskripsi Tugas Patrol berhasil Dihapus';
        return redirect('/patrol-item')->with('msg', $msg);
    }
}
