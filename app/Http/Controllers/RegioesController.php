<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Regioes;

class RegioesController extends Controller
{
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));
        $regiao = Regioes::select('id_regiao',
                                  'nm_regiao')
                         ->where('nm_regiao','LIKE', '%'.$query.'%')
                         ->orWhere('id_regiao',$query)
                         ->orderBy('nm_regiao','desc')                                
                         ->paginate(50);

        return view("regioes.index",["regioes"=>$regiao,"searchText"=>$query]);
    }

    public function create()
    {
        return view("regioes.create");
    }

    public function store(Request $request)
    {
        $regiao = new Regioes();
        $regiao->nm_regiao = strtoupper($request->get('nm_regiao'));
        $regiao->id_user = Auth::id();
        $regiao->created_at = date('Y-m-d H:i:s');
        $regiao->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('regioes');        
    }

    public function show($id)
    {
        $regiao = Regioes::find($id);        
        return view('regioes.show', ['regiao'=>$regiao]);        
    }

    public function edit($id)
    {
        $regiao = Regioes::find($id); 
        $action = action('RegioesController@update', $regiao->id_regiao);

        return view("regioes.edit",[
            "regiao" => $regiao,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $regiao = Regioes::find($id);
        $regiao->nm_regiao = strtoupper($request->get('nm_regiao'));
        $regiao->id_user = Auth::id();
        $regiao->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('regioes');
    }

    public function destroy(Request $request,$id)
    {
        $regiao = Regioes::find($id);
        $regiao->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
