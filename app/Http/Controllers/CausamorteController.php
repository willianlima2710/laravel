<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Causamorte;

class CausamorteController extends Controller
{
    public function index(Request $request)
    {                
        $query=trim($request->get('searchText'));                
        $causamorte = causamorte::select('id_causamorte',
                                         'nm_causamorte')
                                ->where('nm_causamorte','LIKE', '%'.$query.'%')
                                ->orWhere('id_causamorte',$query)
                                ->orderBy('nm_causamorte','desc')                                
                                ->paginate(50);

        return view("causamorte.index",["causamortes"=>$causamorte,"searchText"=>$query]);                                
    }

    public function create()
    {
        return view("causamorte.create");
    }

    public function store(Request $request)
    {
        $causamorte = new Causamorte();
        $causamorte->nm_causamorte = strtoupper($request->get('nm_causamorte'));
        $causamorte->id_user = Auth::id();
        $causamorte->created_at = date('Y-m-d H:i:s');
        $causamorte->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('causamorte');
    }

    public function show($id)
    {
        $causamorte = Causamorte::find($id);        
        return view('causamorte.show', ['causamorte'=>$causamorte]);
    }

    public function edit($id)
    {
        $causamorte = Causamorte::find($id); 
        $action = action('CausamorteController@update', $causamorte->id_causamorte);
        return view("causamorte.edit",[
            "causamorte" => $causamorte,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $causamorte = Causamorte::find($id);
        $causamorte->nm_causamorte = strtoupper($request->get('nm_causamorte'));
        $causamorte->id_user = Auth::id();
        $causamorte->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('causamorte');
    }

    public function destroy(Request $request,$id)
    {
        $causamorte = Causamorte::find($id);
        $causamorte->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
