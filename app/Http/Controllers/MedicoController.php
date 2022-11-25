<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Medico;
use App\Estado;

class MedicoController extends Controller
{   
    public function index(Request $request)
    { 
        $query=trim($request->get('searchText'));        
        $medico = Medico::select('id_medico',
                                 'nm_medico',
                                 'nr_crm',
                                 'nm_especialidade',
                                 'nm_endereco',
                                 'nr_numender',
                                 'nm_bairro',
                                 'nm_cidade',
                                 'nr_cep',
                                 'nm_estado',
                                 'nm_plano1',
                                 'nm_plano2',
                                 'nm_plano3',
                                 'vl_desconto1',
                                 'vl_desconto2',
                                 'vl_desconto3',
                                 'nm_profissional',
                                 'nm_clinica',
                                 'vl_particular',
                                 'vl_convenio',
                                 'nm_telefone1',
                                 'nm_telefone2',
                                 'nm_telefone3',
                                 'nm_obs')
                        ->where('nm_profissional','LIKE', '%'.$query.'%')
                        ->orwhere('nm_especialidade','LIKE', '%'.$query.'%')
                        ->orWhere('id_medico',$query)
                        ->orderBy('nm_profissional','desc')                                
                        ->paginate(50);

        return view("medico.index",["medicos"=>$medico,"searchText"=>$query]); 
    }

    public function create()
    {
        $estado = Estado::orderBy('nm_sigla','asc')->get();

        return view("medico.create",[
            'estado'=>$estado,
        ]);
    }

    public function store(Request $request)
    {
        $medico = new Medico();
        $medico->nm_medico = strtoupper($request->get('nm_medico'));
        $medico->nr_crm = strtoupper($request->get('nr_crm'));
        $medico->nm_especialidade = strtoupper($request->get('nm_especialidade'));
        $medico->nm_endereco = strtoupper($request->get('nm_endereco'));
        $medico->nr_numender = strtoupper($request->get('nr_numender'));
        $medico->nm_bairro = strtoupper($request->get('nm_bairro'));
        $medico->nm_cidade = strtoupper($request->get('nm_cidade'));
        $medico->nr_cep = $request->get('nr_cep');
        $medico->nm_estado = strtoupper($request->get('nm_estado'));
        $medico->nm_plano1 = strtoupper($request->get('nm_plano1'));
        $medico->nm_plano2 = strtoupper($request->get('nm_plano2'));
        $medico->nm_plano3 = strtoupper($request->get('nm_plano3'));
        $medico->vl_desconto1 = $request->get('vl_desconto1');
        $medico->vl_desconto2 = $request->get('vl_desconto2');
        $medico->vl_desconto3 = $request->get('vl_desconto3');
        $medico->nm_profissional = strtoupper($request->get('nm_profissional'));
        $medico->nm_clinica = strtoupper($request->get('nm_clinica'));
        $medico->vl_particular = $request->get('vl_particular');
        $medico->vl_convenio = $request->get('vl_convenio');
        $medico->nm_telefone1 = $request->get('nm_telefone1');
        $medico->nm_telefone2 = $request->get('nm_telefone2');
        $medico->nm_telefone3 = $request->get('nm_telefone3');
        $medico->nm_obs = strtoupper($request->get('nm_obs'));
        $medico->id_user = Auth::id();
        $medico->created_at = date('Y-m-d H:i:s');
        $medico->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('medico');
    }

    public function show($id)
    { 
        $medico = Medico::find($id);
        $estado = Estado::orderBy('nm_sigla','asc')->get();   

        return view('medico.show', [
            'medico'=>$medico,
            'estado'=>$estado,
        ]);        
    }

    public function edit($id)
    {
        $medico = Medico::find($id);
        $estado = Estado::orderBy('nm_sigla','asc')->get();   
        $action = action('MedicoController@update', $medico->id_medico);

        return view("medico.edit",[            
            "medico" => $medico,
            "estado" => $estado,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $medico = Medico::find($id);
        $medico->nm_medico = strtoupper($request->get('nm_medico'));
        $medico->nr_crm = strtoupper($request->get('nr_crm'));
        $medico->nm_especialidade = strtoupper($request->get('nm_especialidade'));
        $medico->nm_endereco = strtoupper($request->get('nm_endereco'));
        $medico->nr_numender = strtoupper($request->get('nr_numender'));
        $medico->nm_bairro = strtoupper($request->get('nm_bairro'));
        $medico->nm_cidade = strtoupper($request->get('nm_cidade'));
        $medico->nr_cep = $request->get('nr_cep');
        $medico->nm_estado = strtoupper($request->get('nm_estado'));
        $medico->nm_plano1 = strtoupper($request->get('nm_plano1'));
        $medico->nm_plano2 = strtoupper($request->get('nm_plano2'));
        $medico->nm_plano3 = strtoupper($request->get('nm_plano3'));
        $medico->vl_desconto1 = $request->get('vl_desconto1');
        $medico->vl_desconto2 = $request->get('vl_desconto2');
        $medico->vl_desconto3 = $request->get('vl_desconto3');
        $medico->nm_profissional = strtoupper($request->get('nm_profissional'));
        $medico->nm_clinica = strtoupper($request->get('nm_clinica'));
        $medico->vl_particular = $request->get('vl_particular');
        $medico->vl_convenio = $request->get('vl_convenio');
        $medico->nm_telefone1 = $request->get('nm_telefone1');
        $medico->nm_telefone2 = $request->get('nm_telefone2');
        $medico->nm_telefone3 = $request->get('nm_telefone3');
        $medico->nm_obs = strtoupper($request->get('nm_obs'));    
        $medico->id_user = Auth::id();
        $medico->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('medico');
    }

    public function destroy(Request $request,$id)
    {
        $medico = Medico::find($id);
        $medico->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
