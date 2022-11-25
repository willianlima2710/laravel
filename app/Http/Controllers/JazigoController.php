<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Jazigo;

class JazigoController extends Controller
{
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));        
        $jazigo = Jazigo::select('id_jazigo',
                                 'cd_jazigo',
                                 'nm_jazigo',
                                 'cd_quadra',
                                 'cd_rua',
                                 'cd_setor',
                                 'st_ocupado',
                                 'st_ativo',
                                 'st_granito',
                                 'nm_obs')
                        ->where('nm_jazigo','LIKE', '%'.$query.'%')
                        ->orWhere('cd_jazigo',$query)
                        ->orderBy('nm_jazigo','desc')                                
                        ->paginate(50);

        return view("jazigo.index",["jazigos"=>$jazigo,"searchText"=>$query]);
    }

    public function create()
    {        
        $granito = [
            0 => [                    
                    'st_granito'=> 0,
                    'nm_granito'=> 'SIM - EMPRESA',
                 ],
            1 => [
                    'st_granito'=> 1,
                    'nm_granito'=> 'SIM - CLIENTE',
                 ],        
            2 => [                    
                    'st_granito'=> 2,
                    'nm_granito'=> 'NÃO',
            ],        

        ];

        return view("jazigo.create", [
            'granitos' => $granito,
        ]);
    }

    public function store(Request $request)
    {
        $jazigo = new Jazigo();
        $jazigo->cd_jazigo = strtoupper($request->get('cd_jazigo'));
        $jazigo->nm_jazigo = strtoupper($request->get('nm_jazigo'));        
        $jazigo->cd_quadra = strtoupper($request->get('cd_quadra'));
        $jazigo->cd_rua = strtoupper($request->get('cd_rua'));
        $jazigo->cd_setor = strtoupper($request->get('cd_setor'));
        $jazigo->st_ocupado = $request->get('st_ocupado') !== null ? '1' : '0';
        $jazigo->st_ativo = $request->get('st_ativo') !== null ? '1' : '0';
        $jazigo->st_granito = $request->get('st_granito');        
        $jazigo->nm_obs = strtoupper($request->get('nm_obs'));
        $jazigo->id_user = Auth::id();
        $jazigo->created_at = date('Y-m-d H:i:s');
        $jazigo->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('jazigo');    
    }

    public function show($id)
    {
        $jazigo = Jazigo::find($id);        
        return view('jazigo.show', ['jazigo'=>$jazigo]);        
    }

    public function edit($id)
    {
        $jazigo = Jazigo::find($id);
        $action = action('JazigoController@update', $jazigo->id_jazigo);

        $granito = [
            0 => [                    
                    'st_granito'=> 0,
                    'nm_granito'=> 'SIM - EMPRESA',
                 ],
            1 => [
                    'st_granito'=> 1,
                    'nm_granito'=> 'SIM - CLIENTE',
                 ],        
            2 => [                    
                    'st_granito'=> 2,
                    'nm_granito'=> 'NÃO',
            ],        

        ];

        return view("jazigo.edit",[
            'jazigo' => $jazigo,
            'action' => $action,
            'granitos' => $granito,
        ]);
    }

    public function update(Request $request, $id)
    {
        $jazigo = Jazigo::find($id);
        $jazigo->cd_jazigo = strtoupper($request->get('cd_jazigo'));
        $jazigo->nm_jazigo = strtoupper($request->get('nm_jazigo'));        
        $jazigo->cd_quadra = strtoupper($request->get('cd_quadra'));
        $jazigo->cd_rua = strtoupper($request->get('cd_rua'));
        $jazigo->cd_setor = strtoupper($request->get('cd_setor'));
        $jazigo->st_ocupado = $request->get('st_ocupado') !== null ? '1' : '0';
        $jazigo->st_ativo = $request->get('st_ativo') !== null ? '1' : '0';
        $jazigo->st_granito = $request->get('st_granito');        
        $jazigo->nm_obs = strtoupper($request->get('nm_obs'));
        $jazigo->id_user = Auth::id();
        $jazigo->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('jazigo');
    }

    public function destroy(Request $request, $id)
    {
        $jazigo = Jazigo::find($id);
        $jazigo->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
