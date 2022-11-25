<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Estcivil;

class EstcivilController extends Controller
{

    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));       
        $estcivil = Estcivil::select('id_estcivil',
                                     'nm_estcivil')
                            ->where('nm_estcivil','LIKE', '%'.$query.'%')
                            ->orWhere('id_estcivil',$query)
                            ->orderBy('nm_estcivil','desc')                                
                            ->paginate(50);

        return view("estcivil.index",["estcivils"=>$estcivil,"searchText"=>$query]);  
    }
    
    public function create()
    {
        return view("estcivil.create");
    }

    public function store(Request $request)
    {
        $estcivil = new Estcivil();
        $estcivil->nm_estcivil = strtoupper($request->get('nm_estcivil'));
        $estcivil->id_user = Auth::id();
        $estcivil->created_at = date('Y-m-d H:i:s');
        $estcivil->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('estcivil');
    }

    public function show($id)
    {
        $estcivil = Estcivil::find($id);        
        return view('estcivil.show', ['estcivil'=>$estcivil]);        
    }

    public function edit($id)
    {
        $estcivil = Estcivil::find($id);
        $action = action('EstcivilController@update', $estcivil->id_estcivil);
        return view("estcivil.edit",[
                    "estcivil" => $estcivil,
                    "action" => $action,
        ]);        
    }

    public function update(Request $request, $id)
    {
        $estcivil = Estcivil::find($id);
        $estcivil->nm_estcivil = strtoupper($request->get('nm_estcivil'));
        $estcivil->id_user = Auth::id();
        $estcivil->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('estcivil');
    }

    public function destroy(Request $request,$id)
    {
        $estcivil = Estcivil::find($id);
        $estcivil->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
