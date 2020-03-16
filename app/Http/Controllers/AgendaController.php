<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function index(){
        $user = Auth::user();
        $agendas = DB::table('agendas')
                    ->leftJoin('pacients', 'agendas.pacient_id', '=', 'pacients.id')
                    ->leftJoin('professionals', 'agendas.professional_id', '=', 'professionals.id')
                    ->select('agendas.*', 'professionals.*', 'pacients.*')
                    ->where('agendas.user_id', $user->id)
                    ->get();
        return view('home', compact('agendas'));
    }
}
