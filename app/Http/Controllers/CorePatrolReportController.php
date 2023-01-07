<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CorePatrolReport;
use App\Models\CorePatrolReportTask;
use Illuminate\Http\Request;

class CorePatrolReportController extends Controller
{
    public function indexReport()
    {
        return view('content/CorePatrolReport/ListPatrolReport', [
            'patrolreports' => CorePatrolReport::where('data_state', '=', 0)
                ->get(),
        ]);
    }
    
    public function indexReportTask($patrol_report_id)
    {
        return view('content/CorePatrolReport/ListPatrolReportTask', [
            'reporttasks' => CorePatrolReportTask::where('data_state', '=', 0)
                ->get(),
        ]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $resorce       = $request->file('image');
            $name          = $resorce->getClientOriginalName();
            $resorce->move(\base_path() . "/public/images", $name);

            $save = CorePatrolReport::where('photos')->insert(['photos' => $name]);
            $msg = 'Foto Berhasil Diupload';
            return redirect('/patrol-report')->with('msg', $msg);
        } else {
            $msg_err = 'Foto Gagal Diupload';
            return redirect('/patrol-report')->with('msg_err', $msg_err);
        }
    }
}
