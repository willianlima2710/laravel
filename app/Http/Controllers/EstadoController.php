<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Estado;

class EstadoController extends Controller
{   
    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));        
        $estado = Estado::select('id_estado',
                                 'nm_estado',
                                 'nm_sigla')
                        ->where('nm_estado','LIKE', '%'.$query.'%')
                        ->orWhere('nm_sigla',$query)
                        ->orWhere('id_estado',$query)
                        ->orderBy('nm_sigla','desc')                                
                        ->paginate(50);

        return view("estado.index",["estados"=>$estado,"searchText"=>$query]);
    }

    public function create()
    {
        return view("estado.create");        
    }

    public function store(Request $request)
    {
        $estado = new Estado();
        $estado->nm_estado = strtoupper($request->get('nm_estado'));
        $estado->nm_sigla = strtoupper($request->get('nm_sigla'));
        $estado->id_user = Auth::id();
        $estado->created_at = date('Y-m-d H:i:s');
        $estado->save();
        
        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('estado');        
    }

    public function show($id)
    {
        $estado = Estado::find($id);        
        return view('estado.show', ['estado'=>$estado]);        
    }

    public function edit($id)
    {
        $estado = Estado::find($id); 
        $action = action('EstadoController@update', $estado->id_estado);
        return view("estado.edit",[
            "estado" => $estado,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {
        $estado = Estado::find($id);
        $estado->nm_estado = strtoupper($request->get('nm_estado'));
        $estado->nm_sigla = strtoupper($request->get('nm_sigla'));
        $estado->id_user = Auth::id();
        $estado->created_at = date('Y-m-d H:i:s');
        $estado->save();
        
        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('estado');                
    }

    public function destroy(Request $request,$id)
    {
        $estado = Estado::find($id);
        $estado->delete();
        
        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
