<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Parentesco;

class ParentescoController extends Controller
{

    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));        
        $parentesco = Parentesco::select('id_parentesco',
                                         'nm_parentesco')
                                ->where('nm_parentesco','LIKE', '%'.$query.'%')
                                ->orWhere('id_parentesco',$query)
                                ->orderBy('nm_parentesco','desc')                                
                                ->paginate(50);

        return view("parentesco.index",["parentescos"=>$parentesco,"searchText"=>$query]);                                

    }

    public function create()
    {
        return view("parentesco.create");
    }

    public function store(Request $request)
    {
        $parentesco = new Parentesco();
        $parentesco->nm_parentesco = strtoupper($request->get('nm_parentesco'));
        $parentesco->id_user = Auth::id();
        $parentesco->created_at = date('Y-m-d H:i:s');
        $parentesco->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('parentesco');                
    }

    public function show($id)
    {
        $parentesco = Parentesco::find($id);        
        return view('parentesco.show', ['parentesco'=>$parentesco]);        
    }

    public function edit($id)
    {
        $parentesco = Parentesco::find($id); 
        $action = action('ParentescoController@update', $parentesco->id_parentesco);
        return view("parentesco.edit",[
            "parentesco" => $parentesco,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {
        $parentesco = Parentesco::find($id);
        $parentesco->nm_parentesco = strtoupper($request->get('nm_parentesco'));
        $parentesco->id_user = Auth::id();
        $parentesco->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('parentesco');
    }

    public function destroy(Request $request,$id)
    {
        $parentesco = Parentesco::find($id);
        $parentesco->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
