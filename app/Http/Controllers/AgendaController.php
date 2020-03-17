<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AgendaRepository;
use App\Repositories\PacientRepository;

class AgendaController extends Controller
{
    private $agendaRepository;
    private $pacientRepository;

    public function __construct(AgendaRepository $agendaRepository, 
                                PacientRepository $pacientRepository){
        $this->agendaRepository  = $agendaRepository;
        $this->pacientRepository = $pacientRepository;
    }
    public function index(){
        $agendas = $this->agendaRepository->getAll();
        return view('home', compact('agendas'));
    }

    public function store(Request $request){
      
		$request->validate([
			'search'      => 'required',
			'search2'     => 'required',
			'data_inicio' => 'required',
			'horas'       => 'required',
		]);
        
        $agenda = $this->agendaRepository->store($request->all());

        if($agenda){
            return back()->with('sucesso', 'Paciente agendado com sucesso.');
        }

        return back()->with('falhou', 'Erro ao tentar agendar.');
		
    }

    public function searchPacient(Request $request){
        $pacient = $this->agendaRepository->searchPacient($request->get('query'));
        return response()->json($pacient);
    }

    public function searchProfessional(Request $request){
        $pacient = $this->agendaRepository->searchProfessional($request->get('term'));
        return $pacient;
    }

    public function storePacient(Request $request){
        $request->validate([
			'name'      => 'required',
			'cpf'       => 'required',
		]);
        
        $pacient = $this->pacientRepository->storePacient($request->all());
        if($pacient){
            return back()->with('sucesso', 'Paciente cadastrado com sucesso.');
        }

        return back()->with('falhou', 'Erro ao tentar cadastrar.');
    }
}
