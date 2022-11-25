<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Banco;

class BancoController extends Controller
{    
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));        
        $banco = Banco::select('id_banco',
                               'nm_banco',
                               'cd_banco',
                               'nr_agencia',
                               'nr_conta',
                               'nm_obs')
                      ->where('nm_banco','LIKE', '%'.$query.'%')
                      ->orWhere('id_banco',$query)
                      ->orderBy('nm_banco','desc')                                
                      ->paginate(50);

       return view("banco.index",["bancos"=>$banco,"searchText"=>$query]);
    }

    public function create()
    {
        return view("banco.create");
    }

    public function store(Request $request)
    {
        $banco = new Banco();
        $banco->nm_banco = strtoupper($request->get('nm_banco'));
        $banco->cd_banco = $request->get('cd_banco');
        $banco->nr_agencia = $request->get('nr_agencia');
        $banco->nr_conta = $request->get('nr_conta');
        $banco->nm_obs = strtoupper($request->get('nm_obs'));
        $banco->id_user = Auth::id();
        $banco->created_at = date('Y-m-d H:i:s');
        $banco->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('banco');        
    }

    public function show($id)
    { 
        $banco = Banco::find($id);   
        return view('banco.show', ['banco'=>$banco]);            
    }

    public function edit($id)
    {
        $banco = Banco::find($id); 
        $action = action('BancoController@update', $banco->id_banco);
        return view("banco.edit",[
            "banco" => $banco,
            "action" => $action,
        ]);        
    }

    public function update(Request $request, $id)
    {        
        $banco = Banco::find($id);
        $banco->nm_banco = strtoupper($request->get('nm_banco'));
        $banco->cd_banco = $request->get('cd_banco');
        $banco->nr_agencia = $request->get('nr_agencia');
        $banco->nr_conta = $request->get('nr_conta');
        $banco->nm_obs = strtoupper($request->get('nm_obs'));
        $banco->id_user = Auth::id();
        $banco->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('banco');        
    }

    public function destroy(Request $request,$id)
    {
        $banco = Banco::find($id);
        $banco->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
