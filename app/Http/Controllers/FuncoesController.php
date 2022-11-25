<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Funcoes;

class FuncoesController extends Controller
{        
    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));
        $funcoes = Funcoes::select('id_funcao',
                                   'nm_funcao')
                          ->where('nm_funcao','LIKE', '%'.$query.'%')
                          ->orWhere('id_funcao',$query)
                          ->orderBy('nm_funcao','desc')                                
                          ->paginate(50);

        return view("funcoes.index",["funcoes"=>$funcoes,"searchText"=>$query]);    
    }

    public function create()
    {
        return view("funcoes.create");
    }

    public function store(Request $request)
    {
        $funcao = new Funcoes();
        $funcao->nm_funcao = strtoupper($request->get('nm_funcao'));
        $funcao->id_user = Auth::id();
        $funcao->created_at = date('Y-m-d H:i:s');
        $funcao->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('funcoes');
    }

    public function show($id)
    {
        $funcao = Funcoes::find($id);        
        return view('funcoes.show', ['funcao'=>$funcao]);
    }

    public function edit($id)
    {        
        $funcao = Funcoes::find($id);
        $action = action('FuncoesController@update', $funcao->id_funcao);
        return view("funcoes.edit",[
            "funcao" => $funcao,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $funcao = Funcoes::find($id);
        $funcao->nm_funcao = strtoupper($request->get('nm_funcao'));
        $funcao->id_user = Auth::id();
        $funcao->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('funcoes');
    }

    public function destroy(Request $request,$id)
    {
        $funcao = Funcoes::find($id);
        $funcao->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
