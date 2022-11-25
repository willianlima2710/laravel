<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Planoconta;

class PlanocontaController extends Controller
{    
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText')); 
        $planoconta = Planoconta::select('id_planoconta',
                                         'nm_planoconta',
                                         'cd_conta',
                                         'cd_pai',
                                         'nr_ordem',
                                         'cd_reduzido',
                                         'st_tipo')
                                ->where('nm_planoconta','LIKE', '%'.$query.'%')
                                ->orWhere('id_planoconta',$query)
                                ->orderBy('nm_planoconta','desc')                                
                                ->paginate(50);

        return view("planoconta.index",["planocontas"=>$planoconta,"searchText"=>$query]); 
    }

    public function create()
    {
        $tipo = [
            0 => [
                    'st_tipo'=> 0,
                    'nm_tipo'=> 'CREDITO',
                 ],
            1 => [
                    'st_tipo'=> 1,
                    'nm_tipo'=> 'DEBITO',
                 ],        
        ];

        return view("planoconta.create",[
            "tipo"=>$tipo,
        ]);
    }

    public function store(Request $request)
    {
        $planoconta = new Planoconta();
        $planoconta->nm_planoconta = strtoupper($request->get('nm_planoconta'));
        $planoconta->cd_conta = $request->get('cd_conta');
        $planoconta->cd_pai = $request->get('cd_pai');
        $planoconta->nr_ordem = $request->get('nr_ordem');
        $planoconta->cd_reduzido = $request->get('cd_reduzido');
        $planoconta->st_tipo = $request->get('st_tipo');
        $planoconta->id_user = Auth::id();
        $planoconta->created_at = date('Y-m-d H:i:s');
        $planoconta->save();
        
        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('planoconta');
    }

    public function show($id)
    {
        $planoconta = Planoconta::find($id); 
        return view('planoconta.show', ['planoconta'=>$planoconta]);               
    }

    public function edit($id)
    {
        $planoconta = Planoconta::find($id); 
        $action = action('PlanocontaController@update', $planoconta->id_planoconta);

        $tipo = [
            0 => [
                    'st_tipo'=> 0,
                    'nm_tipo'=> 'CREDITO',
                 ],
            1 => [
                    'st_tipo'=> 1,
                    'nm_tipo'=> 'DEBITO',
                 ],        
        ];

        return view("planoconta.edit",[
            "planoconta" => $planoconta,
            "tipo" => $tipo,
            "action" => $action,
        ]);       
    }

    public function update(Request $request, $id)
    {
        $planoconta = Planoconta::find($id);
        $planoconta->nm_planoconta = strtoupper($request->get('nm_planoconta'));
        $planoconta->cd_conta = $request->get('cd_conta');
        $planoconta->cd_pai = $request->get('cd_pai');
        $planoconta->nr_ordem = $request->get('nr_ordem');
        $planoconta->cd_reduzido = $request->get('cd_reduzido');
        $planoconta->st_tipo = $request->get('st_tipo');
        $planoconta->id_user = Auth::id();
        $planoconta->created_at = date('Y-m-d H:i:s');
        $planoconta->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('planoconta');
    }

    public function destroy(Request $request,$id)
    {
        $planoconta = Planoconta::find($id);
        $planoconta->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
