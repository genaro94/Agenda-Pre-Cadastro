<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Agenda;

class AgendaRepository {

    public function getAll(){
        $user = Auth::user();
        $agendas = DB::table('agendas')
                    ->leftJoin('pacients', 'agendas.pacient_id', '=', 'pacients.id')
                    ->leftJoin('professionals', 'agendas.professional_id', '=', 'professionals.id')
                    ->leftJoin('users', 'agendas.user_id', '=', 'users.id')
                    ->select('users.*', 'pacients.*','professionals.*', 'agendas.*')
                    ->where('agendas.user_id', $user->id)
                    ->get();
        return $agendas;
    }

    public function store($data){
        $data['user_id']     = Auth::user()->id;
        $data['date'] = date_create_from_format('d/m/Y H:i:s',$data['data_inicio']. ' '.$data['horas']. ':00')
                                ->format('Y-m-d H:i:s');
        $data['assunto']     = $data['assunto'];

        $professional = DB::table('users')->where('permission', 'professional')
                         ->where('name', $data['search'])->first();

        $paciente = DB::table('users')->where('permission', 'pacient')
                      ->where('name', $data['search2'])->first();

        if($professional && $paciente){

          $data['pacient_id']      = $paciente->id;
          $data['professional_id'] = $professional->id;

          return (new Agenda)->create($data);
        }
    }

    public function searchPacient($name){
        $result  = DB::table('users')
                        ->where('name', 'LIKE', '%'. $name. '%')
                        ->where('permission', 'pacient')
                        ->get();

        if(count($result) > 0){
            $output = '<ul class="dropdown-menu" style="display:contents;position:relative;" >';
            foreach($result as $row){
                $output .= '<li class=" autocomplete-manual"><a href="#"  style="padding-left: 6px;">'.$row->name.'</a></li>';
            }
            $output .= '</ul>';
            return $output;
        }
        else{
            $output = '<ul class="dropdown-menu" style="display:contents;position:relative;" >';
            $output .= '<li class=" autocomplete-manual">
                            <a data-toggle="modal" data-target="#addNovoPaciente" href="#" style="padding-left: 6px;">
                                <i class="fas fa-plus" style="padding-right:5px"></i> Adicionar paciente
                            </a>
                        </li>';
            $output .= '</ul>';
            return $output;
        }
    }

    public function searchProfessional($name){
      $professional =  DB::table('users')
                          ->where('name', 'LIKE', '%'. $name. '%')
                          ->where('permission', 'professional')
                          ->get();
      return $professional;
    }
}