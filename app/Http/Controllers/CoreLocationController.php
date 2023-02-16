<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CoreLocation;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\Auth;


class CoreLocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('content/CoreLocation/ListCoreLocation', [
            'corelocation' => CoreLocation::where('data_state', '=', 0)
                ->get(),
        ]);
    }

    public function addCoreLocation(Request $request){
        $corelocation = CoreLocation::where('data_state', '=', 0)->get();
        return view('content.CoreLocation.AddCoreLocation', compact('corelocation'));
    }

    public function processAddCoreLocation(Request $request){
        $fields = $request->validate([
            'location_name'             => 'required',
            'location_longtitude'       => 'required',
            'location_latitude'         => 'required',
        ]);

        $data = [
            'location_name'             => $fields['location_name'],
            'location_longtitude'       => $fields['location_longtitude'],
            'location_latitude'         => $fields['location_longtitude'],
            'created_id'                => Auth::id(),
            'created_at'                => date('Y-m-d'),
        ];

        if(CoreLocation::insert($data)){
            $msg = 'Tambah Lokasi Patroli Berhasil';
        }else{
            $msg = 'Tambah Lokasi Patroli Gagal';
        }

        return redirect('/location/add-location')->with('msg', $msg);
    }

    public function editCoreLocation($location_id){
        $corelocation = CoreLocation::where('data_state', '=', 0)
        ->where('location_id', $location_id)
        ->first();
        //dd($editpatrols);
        return view('content.CoreLocation.EditCoreLocation', compact('corelocation'));
    }

    public function processEditCoreLocation(Request $request)
    {
        $fields = $request->validate([
            'location_id'                => 'required',
            'location_name'              => 'required',
            'location_longtitude'        => 'required',
            'location_latitude'          => 'required',
        ]);

        $data = CoreLocation::where('location_id', $fields['location_id'])->update([
            'location_name'              => $fields['location_name'],
            'location_longtitude'        => $fields['location_longtitude'],
            'location_latitude'          => $fields['location_latitude'],
            'created_id'                 => Auth::id(),
            'created_at'                 => date('Y-m-d'),

        ]);

        $msg = 'Edit Lokasi Patroli Berhasil';
        return redirect('/location')->with('msg', $msg);
    }

    public function printQR($location_id)
    {
        $corelocation = CoreLocation::where('location_id', $location_id)->first();

        // create new PDF document
        $pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);


        // ---------------------------------------------------------
        $export = "
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div style=\"text-align:center !important;\">
            <a style=\"color: black; text-decoration: none; font-family: 'Times New Roman', Times, serif; font-size: 10px\">Lokasi:" . $corelocation['location_name'] . ", Long:" . $corelocation['location_longtitude'] . ", Lat:" . $corelocation['location_latitude'] . "</a>
        </div>
        ";
        $pdf::AddPage();

        // ----------------------------------------------------------

        $style = array(
            'align-item' => 'center',
        );

        $pdf::writeHTML($export, true, false, false, false, '');
        $pdf::write2DBarcode($location_id, 'QRCODE,H', 70, 90, 70, 120, $style, 'N');
        if (ob_get_contents()) ob_end_clean();
        // -----------------------------------------------------------------------------

        //Close and output PDF document
        $filename = 'QR Code Titik Koordinat Patrol_' . $location_id . '.pdf';
        $pdf::Output($filename, 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }

    public function printAllQR($patrol_location_id)
    {

        $data_print = CoreLocation::where('data_state', 0)->get();

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
                <a class=\"pt-100;\" style=\"color: black; text-decoration: none;  font-family: 'Times New Roman', Times, serif; font-size:10px;\">Lokasi:" . $val['location_name'] . ", Long:" . $val['location_longtitude'] . ", Lat:" . $val['location_latitude'] . "</a>
            </div>
            <br pagebreak=\"true;\" />
            ";
            $pdf::writeHTML($export, true, false, false, false, '');
            $pdf::write2DBarcode((string)$val['location_id'], 'QRCODE,H', 70, 90, 70, 100, $style, 'N');
            $pdf::AddPage();
        }
        $pdf::lastPage();
        $filename = 'QR Code Titik Koordinat Patrol_' . $val . '.pdf';
        $pdf::Output($filename, 'I');
    }

    public function deleteCoreLocation($location_id)
    {
        $corelocations = CoreLocation::findOrFail($location_id);
        // $corelocations->deleted_id = Auth::id();
        $corelocations->data_state = 1;

        if ($corelocations->save()) {
            $msg = 'Lokasi Patroli Berhasil Dihapus';
        } else {
            $msg = 'Lokasi Patroli Gagal Dihapus';
        }
        // $patrols = CorePatrol::where('patrol_id', $id)->delete();
        // $msg = 'Deskripsi Tugas Patrol berhasil Dihapus';
        return redirect('/location')->with('msg', $msg);
    }
}
