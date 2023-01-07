<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CorePatrol;
use App\Models\CorePersonnelScheduling;
use Illuminate\Http\Request;

class CorePersonnelSchedulingController extends Controller
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
        return view('content/CorePersonnelScheduling/ListPersonnelScheduling', [
            'personnel_schedulings' => CorePatrol::where('data_state', '=', 0)->get(),
        ]);
    }

    public function viewPersonnelScheduling($id)
    {
        return view('content/CorePersonnelScheduling/CreatePersonnelScheduling');
        // return redirect('/personnel-scheduling/view-personnel-scheduling/' . $id);
    }
}
