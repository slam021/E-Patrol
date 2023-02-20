<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\CorePersonnel;
use App\Models\CoreLocation;
use App\Models\CorePollingStation;
use App\Models\CoreSchedule;
use App\Models\CoreShift;
use App\Models\CoreSupporter;
use App\Models\CoreTimses;

class HomeController extends Controller
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
        Session::forget('start_date');
        Session::forget('end_date');
        Session::forget('financial_flow_code');

        $menus =  User::select('system_menu_mapping.*','system_menu.*')
        ->join('system_user_group','system_user_group.user_group_id','=','system_user.user_group_id')
        ->join('system_menu_mapping','system_menu_mapping.user_group_level','=','system_user_group.user_group_level')
        ->join('system_menu','system_menu.id_menu','=','system_menu_mapping.id_menu')
        ->where('system_user.user_id','=',Auth::id())
        ->orderBy('system_menu_mapping.id_menu','ASC')
        ->get();

        $corepersonnel = CorePersonnel::where('data_state', '=', 0)
        ->get();

        $corelocation = CoreLocation::where('data_state', '=', 0)
        ->get();

        $coreshift = CoreShift::where('data_state', '=', 0)
        ->get();

        $coreschedule = CoreSchedule::where('data_state', '=', 0)
        ->get();

        // $coretimses = CoreTimses::select('core_timses.*')
        // ->where('data_state', '=', 0)
        // ->get();

        return view('home',compact('menus', 'corepersonnel', 'corelocation', 'coreshift', 'coreschedule'));
    }
}
