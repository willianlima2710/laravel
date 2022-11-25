<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Cemiterio;
use App\Estado;

class CemiterioController extends Controller
{
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));                
        $cemiterio = Cemiterio::select('id_cemiterio',
                                       'nm_cemiterio',
                                       'nm_endereco',
                                       'nr_numender',
                                       'nm_bairro',
                                       'nm_cidade',
                                       'nm_estado')
                              ->where('nm_cemiterio','LIKE', '%'.$query.'%')
                              ->orWhere('id_cemiterio',$query)
                              ->orderBy('nm_cemiterio','desc')                                
                              ->paginate(50);

        return view("cemiterio.index",["cemiterios"=>$cemiterio,"searchText"=>$query]);    
    }

    public function create()
    {
        $estado = Estado::orderBy('nm_sigla','asc')->get();
        return view("cemiterio.create",['estados'=>$estado]);
    }

    public function store(Request $request)
    {
        $cemiterio = new Cemiterio();
        $cemiterio->nm_cemiterio = strtoupper($request->get('nm_cemiterio'));
        $cemiterio->nm_endereco = strtoupper($request->get('nm_endereco'));
        $cemiterio->nr_numender = $request->get('nr_numender');
        $cemiterio->nm_bairro = strtoupper($request->get('nm_bairro'));
        $cemiterio->nm_cidade = strtoupper($request->get('nm_cidade'));
        $cemiterio->nm_estado = strtoupper($request->get('nm_estado'));
        $cemiterio->id_user = Auth::id();
        $cemiterio->created_at = date('Y-m-d H:i:s');
        $cemiterio->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('cemiterio');        
    }

    public function show($id)
    { 
        $cemiterio = Cemiterio::find($id);        
        return view('cemiterio.show', ['cemiterio'=>$cemiterio]);        
    }

    public function edit($id)
    {
        $cemiterio = Cemiterio::find($id); 
        $estado = Estado::orderBy('nm_sigla','asc')->get();

        $action = action('CemiterioController@update', $cemiterio->id_cemiterio);
        return view("cemiterio.edit",[
            "cemiterio" => $cemiterio,
            "estados" => $estado,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $cemiterio = Cemiterio::find($id);
        $cemiterio->nm_cemiterio = strtoupper($request->get('nm_cemiterio'));
        $cemiterio->nm_endereco = strtoupper($request->get('nm_endereco'));
        $cemiterio->nr_numender = strtoupper($request->get('nr_numender'));
        $cemiterio->nm_bairro = strtoupper($request->get('nm_bairro'));
        $cemiterio->nm_cidade = strtoupper($request->get('nm_cidade'));
        $cemiterio->nm_estado = strtoupper($request->get('nm_estado'));
        $cemiterio->id_user = Auth::id();
        $cemiterio->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('cemiterio');
    }

    public function destroy(Request $request,$id)
    {
        $cemiterio = Cemiterio::find($id);
        $cemiterio->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
