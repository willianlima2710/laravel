<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Fxacidade;

class FxacidadeController extends Controller
{
    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));
        $fxacidades = Fxacidade::select('id_fxacidade',
                                       'nm_fxacidade',
                                       'nr_idadeinicial',
                                       'nr_idadefinal',
                                       'vl_acrescentar')
                              ->where('nm_fxacidade','LIKE', '%'.$query.'%')
                              ->orWhere('id_fxacidade',$query)
                              ->orderBy('nm_fxacidade','desc')                                
                              ->paginate(50);

        return view("fxacidade.index",["fxacidades"=>$fxacidades,"searchText"=>$query]);            
    }

    public function create()
    {
        return view("fxacidade.create");
    }

    public function store(Request $request)
    {
        $fxacidade = new Fxacidade();
        $fxacidade->nm_fxacidade = strtoupper($request->get('nm_fxacidade'));
        $fxacidade->nr_idadeinicial = $request->get('nr_idadeinicial');
        $fxacidade->nr_idadefinal = $request->get('nr_idadefinal');
        $fxacidade->vl_acrescentar = $request->get('vl_acrescentar');        
        $fxacidade->id_user = Auth::id();
        $fxacidade->created_at = date('Y-m-d H:i:s');
        $fxacidade->save();
                
        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('fxacidade');
    }

    public function show($id)
    {
        $fxacidade = Fxacidade::find($id);        
        return view('fxacidade.show', ['fxacidade'=>$fxacidade]);
    }

    public function edit($id)
    {
        $fxacidade = Fxacidade::find($id);
        $action = action('FxacidadeController@update', $fxacidade->id_fxacidade);
        return view("fxacidade.edit",[
            "fxacidade" => $fxacidade,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $fxacidade = Fxacidade::find($id);
        $fxacidade->nm_fxacidade = strtoupper($request->get('nm_fxacidade'));
        $fxacidade->nr_idadeinicial = $request->get('nr_idadeinicial');
        $fxacidade->nr_idadefinal = $request->get('nr_idadefinal');
        $fxacidade->vl_acrescentar = $request->get('vl_acrescentar');    
        $fxacidade->id_user = Auth::id();
        $fxacidade->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('fxacidade');
    }

    public function destroy(Request $request,$id)
    {
        $fxacidade = Fxacidade::find($id);
        $fxacidade->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
