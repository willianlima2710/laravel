<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Capela;

class CapelaController extends Controller
{    
    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));        
        $capela = Capela::select('id_capela',
                                 'nm_capela',
                                 'nm_obs')
                      ->where('nm_capela','LIKE', '%'.$query.'%')
                      ->orWhere('id_capela',$query)
                      ->orderBy('nm_capela','desc')                                
                      ->paginate(50);

       return view("capela.index",["capelas"=>$capela,"searchText"=>$query]);
    }

    public function create()
    {
        return view("capela.create");
    }

    public function store(Request $request)
    {
        $capela = new Capela();
        $capela->nm_capela = strtoupper($request->get('nm_capela'));
        $capela->nm_obs = strtoupper($request->get('nm_obs'));
        $capela->id_user = Auth::id();
        $capela->created_at = date('Y-m-d H:i:s');
        $capela->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('capela');        
    }

    public function show($id)
    {
        $capela = Capela::find($id);   
        return view('capela.show', ['capela'=>$capela]);            
    }

    public function edit($id)
    {
        $capela = Capela::find($id); 
        $action = action('CapelaController@update', $capela->id_capela);
        return view("capela.edit",[
            "capela" => $capela,
            "action" => $action,
        ]);                
    }

    public function update(Request $request, $id)
    {
        $capela = Capela::find($id);
        $capela->nm_capela = strtoupper($request->get('nm_capela'));
        $capela->nm_obs = strtoupper($request->get('nm_obs'));
        $capela->id_user = Auth::id();
        $capela->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('capela');                
    }

    public function destroy(Request $request,$id)
    {
        $capela = Capela::find($id);
        $capela->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();                
    }
}
