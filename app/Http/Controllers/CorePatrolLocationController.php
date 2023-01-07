<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CorePatrolLocation;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\Auth;


class CorePatrolLocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('content/CorePatrolLocation/ListPatrolLocation', [
            'patrol_locations' => CorePatrolLocation::where('data_state', '=', 0)
                ->get(),
        ]);
    }

    public function createCorePatrolLocation(Request $request)
    {
        $createpatrollocations = CorePatrolLocation::where('data_state', '=', 0)->get();
        return view('content.CorePatrolLocation.CreatePatrolLocation', compact('createpatrollocations'));
    }

    public function storeCorePatrolLocation(Request $request)
    {
        $request->validate([
            'location_name'             => 'required|string|max:100',
            'longtitude'                => 'required',
            'latitude'                  => 'required',
        ]);

        $storepatrolLocations = CorePatrolLocation::create([
            'location_name'              => $request->location_name,
            'longtitude'                 => $request->longtitude,
            'latitude'                   => $request->latitude,
            'created_id'                 => Auth::id(),
        ]);
        $msg = 'Tambah Titik Koordinat & Waktu Patroli Berhasil';
        return redirect('/patrol-location/create-patrol-location')->with('msg', $msg);
    }

    public function editCorePatrolLocation($id)
    {
        $editpatrollocations = CorePatrolLocation::where('patrol_Location_id', $id)->first();
        //dd($editpatrols);
        return view('content.CorePatrolLocation.EditPatrolLocation', compact('editpatrollocations'));
    }

    public function updateCorePatrolLocation(Request $request, $id)
    {
        $request->validate([
            'location_name'             => 'required|string|max:100',
            'longtitude'                => 'required',
            'latitude'                  => 'required',
        ]);

        $updatelocations = CorePatrolLocation::where('patrol_Location_id', $id)->update([
            'location_name'              => $request->location_name,
            'longtitude'                 => $request->longtitude,
            'latitude'                   => $request->latitude,
            'updated_id'                 => Auth::id(),

        ]);

        $msg = 'Titik Koordinat & Waktu Patroli';
        return redirect('/patrol-location')->with('msg', $msg);
    }

    public function printQR($patrol_location_id)
    {
        $corepatrollocation = CorePatrolLocation::where('patrol_location_id', $patrol_location_id)->first();

        // create new PDF document
        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);


        // ---------------------------------------------------------
        $export = "
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div style=\"text-align:center !important;\">
            <a style=\"color: black; text-decoration: none; font-family: 'Times New Roman', Times, serif; font-size: 10px\">Lokasi:" . $corepatrollocation['location_name'] . ", Long:" . $corepatrollocation['longtitude'] . ", Lat:" . $corepatrollocation['latitude'] . "</a>
        </div>
        ";
        $pdf::AddPage();

        // ----------------------------------------------------------

        $style = array(
            'align-item' => 'center',
        );

        $pdf::writeHTML($export, true, false, false, false, '');
        $pdf::write2DBarcode($patrol_location_id, 'QRCODE,H', 70, 90, 70, 120, $style, 'N');
        if (ob_get_contents()) ob_end_clean();
        // -----------------------------------------------------------------------------

        //Close and output PDF document
        $filename = 'QR Code Titik Koordinat Patrol_' . $patrol_location_id . '.pdf';
        $pdf::Output($filename, 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }

    public function printAllQR($patrol_location_id)
    {

        $data_print = CorePatrolLocation::where('data_state', 0)->get();

        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

        $pdf::SetMargins(6, 6, 6, 6); // put space of 10 on top

        // ---------------------------------------------------------

        // set font
        $pdf::SetFont('helvetica', 'B', 20);

        // add a page
        $pdf::AddPage();

        /*$pdf::Write(0, 'Example of HTML tables', '', 0, 'L', true, 0, false, false, 0);*/

        $pdf::SetFont('helvetica', '', 10);
        $pdf::SetAutoPageBreak(TRUE);
        // -----------------------------------------------------------------------------

        $style = array(
            'align-item' => 'center',
        );
        // print_r($data_print);
        // exit();
        // -----------------------------------------------------------------------------
        foreach ($data_print as $key => $val) {
            $export = "
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            
            <div style=\"text-align:center !important;\">
                <a class=\"pt-100;\" style=\"color: black; text-decoration: none;  font-family: 'Times New Roman', Times, serif; font-size:10px;\">Lokasi:" . $val['location_name'] . ", Long:" . $val['longtitude'] . ", Lat:" . $val['latitude'] . "</a>
            </div>
            <br pagebreak=\"true;\" />
            ";
            $pdf::writeHTML($export, true, false, false, false, '');
            $pdf::write2DBarcode((string)$val['patrol_location_id'], 'QRCODE,H', 70, 90, 70, 100, $style, 'N');
            $pdf::AddPage();
        }
        $pdf::lastPage();
        $filename = 'QR Code Titik Koordinat Patrol_' . $val . '.pdf';
        $pdf::Output($filename, 'I');
    }

    public function deleteCorePatrolLocation($id)
    {
        $patrollocations = CorePatrolLocation::findOrFail($id);
        $patrollocations->deleted_id = Auth::id();
        $patrollocations->data_state = 1;

        if ($patrollocations->save()) {
            $msg = 'Lokasi Patroli Berhasil Dihapus';
        } else {
            $msg = 'Lokasi Patroli Gagal Dihapus';
        }
        // $patrols = CorePatrol::where('patrol_id', $id)->delete();
        // $msg = 'Deskripsi Tugas Patrol berhasil Dihapus';
        return redirect('/patrol-location')->with('msg', $msg);
    }
}
