<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Plano;

class PlanoController extends Controller
{    
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));
        $planos = Plano::select('id_plano',
                                'nm_plano',
                                'vl_cobertura',
                                'vl_kmincluido',
                                'vl_plano',
                                'vl_salminino',
                                'vl_jurosdia',
                                'vl_multa',
                                'vl_adesao',
                                'nm_obs')
                       ->where('nm_plano','LIKE', '%'.$query.'%')
                       ->orWhere('id_plano',$query)
                       ->orderBy('nm_plano','desc')                                
                       ->paginate(50);

        return view("plano.index",["planos"=>$planos,"searchText"=>$query]);                                
    }

    public function create()
    {
        return view("plano.create");
    }

    public function store(Request $request)
    {
        $plano = new Plano();
        $plano->nm_plano = strtoupper($request->get('nm_plano'));
        $plano->vl_cobertura = $request->get('vl_cobertura');
        $plano->vl_kmincluido = $request->get('vl_kmincluido');
        $plano->vl_plano = $request->get('vl_plano');
        $plano->vl_salminino = $request->get('vl_salminino');
        $plano->vl_jurosdia = $request->get('vl_jurosdia');
        $plano->vl_multa = $request->get('vl_multa');
        $plano->vl_adesao = $request->get('vl_adesao');
        $plano->nm_obs = strtoupper($request->get('nm_obs'));
        $plano->id_user = Auth::id();
        $plano->created_at = date('Y-m-d H:i:s');
        $plano->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('plano');        
    }

    public function show($id)
    { 
        $plano = Plano::find($id);
        return view('plano.show', ['plano'=>$plano]);                

    }

    public function edit($id)
    {
        $plano = Plano::find($id); 
        $action = action('PlanoController@update', $plano->id_plano);
        return view("plano.edit",[            
            "plano" => $plano,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $plano = Plano::find($id);
        $plano->nm_plano = strtoupper($request->get('nm_plano'));
        $plano->vl_cobertura = $request->get('vl_cobertura');
        $plano->vl_kmincluido = $request->get('vl_kmincluido');
        $plano->vl_plano = $request->get('vl_plano');
        $plano->vl_salminino = $request->get('vl_salminino');
        $plano->vl_jurosdia = $request->get('vl_jurosdia');
        $plano->vl_multa = $request->get('vl_multa');
        $plano->vl_adesao = $request->get('vl_adesao');
        $plano->nm_obs = strtoupper($request->get('nm_obs'));
        $plano->id_user = Auth::id();
        $plano->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('plano');
    }

    public function destroy(Request $request,$id)
    {
        $plano = Plano::find($id);
        $plano->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
