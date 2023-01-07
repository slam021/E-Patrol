<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CorePersonnelPresence;
use Illuminate\Http\Request;

class CorePersonnelPresenceController extends Controller
{
    public function index()
    {
        return view('content/CorePersonnelPresence/ListPersonnelPresence', [
            'personnelpresences' => CorePersonnelPresence::where('data_state', '=', 0)
                ->get(),
        ]);
    }
}
