<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Custo;

class CustoController extends Controller
{

    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));        
        $custo = Custo::select('id_custo',
                               'nm_custo',
                               'vl_custo',
                               'nr_dia',
                               'st_periodo',
                               'nm_obs')
                      ->where('nm_custo','LIKE', '%'.$query.'%')
                      ->orWhere('id_custo',$query)
                      ->orderBy('nm_custo','desc')
                      ->paginate(50);

        return view("custo.index",["custos"=>$custo,"searchText"=>$query]);                                
    }

    public function create()
    {
        $periodo = [
            0 => [                
                    'st_periodo'=> 0,
                    'nm_periodo'=> 'MENSAL',
                 ],
            1 => [
                    'st_periodo'=> 1,
                    'nm_periodo'=> 'TRIMESTRAL',
                 ],        
            2 => [
                    'st_periodo'=> 2,
                    'nm_periodo'=> 'SEMESTRAL',
                 ],        
            3 => [
                    'st_periodo'=> 3,
                    'nm_periodo'=> 'ANUAL',
                 ],        

        ];

        return view("custo.create",[
            "periodo"=>$periodo,
        ]);        
    }

    public function store(Request $request)
    {
        $custo = new Custo();
        $custo->nm_custo = strtoupper($request->get('nm_custo'));
        $custo->vl_custo = $request->get('vl_custo');
        $custo->nr_dia = $request->get('nr_dia');
        $custo->st_periodo = $request->get('st_periodo');
        $custo->nm_obs = strtoupper($request->get('nm_obs'));
        $custo->id_user = Auth::id();
        $custo->created_at = date('Y-m-d H:i:s');
        $custo->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('custo');
    }

    public function show($id)
    { 
        $custo = Custo::find($id);        
        return view('custo.show', ['custo'=>$custo]);        
    }

    public function edit($id)
    {
        $custo = Custo::find($id); 
        $action = action('CustoController@update', $custo->id_custo);

        $periodo = [
            0 => [                
                    'st_periodo'=> 0,
                    'nm_periodo'=> 'MENSAL',
                 ],
            1 => [
                    'st_periodo'=> 1,
                    'nm_periodo'=> 'TRIMESTRAL',
                 ],        
            2 => [
                    'st_periodo'=> 2,
                    'nm_periodo'=> 'SEMESTRAL',
                 ],        
            3 => [
                    'st_periodo'=> 3,
                    'nm_periodo'=> 'ANUAL',
                 ],        

        ];


        return view("custo.edit",[            
            "custo" => $custo,
            "periodo" => $periodo,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $custo = Custo::find($id);
        $custo->nm_custo = strtoupper($request->get('nm_custo'));
        $custo->vl_custo = $request->get('vl_custo');
        $custo->nr_dia = $request->get('nr_dia');
        $custo->st_periodo = $request->get('st_periodo');
        $custo->nm_obs = strtoupper($request->get('nm_obs'));
        $custo->id_user = Auth::id();
        $custo->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('custo');
    }

    public function destroy($id)
    {
        $custo = Custo::find($id);
        $custo->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
