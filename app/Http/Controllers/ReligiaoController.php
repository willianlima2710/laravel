<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Religiao;

class ReligiaoController extends Controller
{
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));        
        $religiao = Religiao::select('id_religiao',
                                     'nm_religiao')
                            ->where('nm_religiao','LIKE', '%'.$query.'%')
                            ->orWhere('id_religiao',$query)
                            ->orderBy('nm_religiao','desc')                                
                            ->paginate(50);

        return view("religiao.index",["religiaos"=>$religiao,"searchText"=>$query]); 
    }

    public function create()
    {
        return view("religiao.create");
    }

    public function store(Request $request)
    {
        $religiao = new Religiao();
        $religiao->nm_religiao = strtoupper($request->get('nm_religiao'));
        $religiao->id_user = Auth::id();
        $religiao->created_at = date('Y-m-d H:i:s');
        $religiao->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('religiao');
    }

    public function show($id)
    {
        $religiao = Religiao::find($id); 
        return view('religiao.show', ['religiao'=>$religiao]);               
    }

    public function edit($id)
    {
        $religiao = Religiao::find($id);        
        $action = action('ReligiaoController@update', $religiao->id_religiao);

        return view("religiao.edit",[
            "religiao" => $religiao,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $religiao = Religiao::find($id);
        $religiao->nm_religiao = strtoupper($request->get('nm_religiao'));
        $religiao->id_user = Auth::id();
        $religiao->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('religiao');
    }

    public function destroy(Request $request,$id)
    {
        $religiao = Religiao::find($id);
        $religiao->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
