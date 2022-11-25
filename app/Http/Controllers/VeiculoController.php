<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Veiculo;
use Functions;

class VeiculoController extends Controller
{
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));        
        $veiculo = Veiculo::select('id_veiculo',
                                   'nm_veiculo',
                                   'nr_placa',
                                   'nm_marca',
                                   'nm_cor',
                                   'nr_ano',
                                   'nm_seguradora',
                                   'dt_vigencia',
                                   'nm_condutor',
                                   'dt_manutencao')
                          ->where('nm_veiculo','LIKE', '%'.$query.'%')
                          ->orWhere('nr_placa',$query)
                          ->orderBy('nm_veiculo','desc')                                
                          ->paginate(50);

        return view("veiculo.index",["veiculos"=>$veiculo,"searchText"=>$query]);                                
    }

    public function create()
    {
        return view("veiculo.create");
    }

    public function store(Request $request)
    {
        $veiculo = new Veiculo();
        $veiculo->nm_veiculo = strtoupper($request->get('nm_veiculo'));
        $veiculo->nr_placa = strtoupper($request->get('nr_placa'));
        $veiculo->nm_marca = strtoupper($request->get('nm_marca'));
        $veiculo->nm_cor = strtoupper($request->get('nm_cor'));
        $veiculo->nr_ano = $request->get('nr_ano');
        $veiculo->nm_seguradora = strtoupper($request->get('nm_seguradora'));
        $veiculo->dt_vigencia = Functions::DateToEua($request->get('dt_vigencia'));
        $veiculo->nm_condutor = strtoupper($request->get('nm_condutor'));
        $veiculo->dt_manutencao = Functions::DateToEua($request->get('dt_manutencao'));
        $veiculo->id_user = Auth::id();
        $veiculo->created_at = date('Y-m-d H:i:s');
        $veiculo->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('veiculo');
    }

    public function show($id)
    { 
        $veiculo = Veiculo::find($id); 
        return view('veiculo.show', ['veiculo'=>$veiculo]);               
    }

    public function edit($id)
    {
        $veiculo = Veiculo::find($id); 
        $action = action('VeiculoController@update', $veiculo->id_veiculo);
        
        return view("veiculo.edit",[
            "veiculo" => $veiculo,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $veiculo = Veiculo::find($id);
        $veiculo->nm_veiculo = strtoupper($request->get('nm_veiculo'));
        $veiculo->nr_placa = strtoupper($request->get('nr_placa'));
        $veiculo->nm_marca = strtoupper($request->get('nm_marca'));
        $veiculo->nm_cor = strtoupper($request->get('nm_cor'));
        $veiculo->nm_seguradora = strtoupper($request->get('nm_seguradora'));
        $veiculo->dt_vigencia = Functions::DateToEua($request->get('dt_vigencia'));
        $veiculo->nm_condutor = strtoupper($request->get('nm_condutor'));
        $veiculo->dt_manutencao = Functions::DateToEua($request->get('dt_manutencao'));
        $veiculo->id_user = Auth::id();
        $veiculo->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('veiculo');
    }

    public function destroy(Request $request,$id)
    {
        $veiculo = Veiculo::find($id);
        $veiculo->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
