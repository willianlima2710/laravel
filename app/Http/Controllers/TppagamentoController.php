<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Tppagamento;

class TppagamentoController extends Controller
{

    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));
        $tppagamento = Tppagamento::select('id_tppagamento',
                                           'nm_tppagamento',
                                           'st_avista')
                                   ->where('nm_tppagamento','LIKE', '%'.$query.'%')
                                   ->orWhere('id_tppagamento',$query)
                                   ->orderBy('nm_tppagamento','asc')                                
                                   ->paginate(50);

        return view("tppagamento.index",["tppagamentos"=>$tppagamento,"searchText"=>$query]);
    }

    public function create()
    {
        return view("tppagamento.create");        
    }

    public function store(Request $request)
    {        
        $tppagamento = new Tppagamento();
        $tppagamento->nm_tppagamento = strtoupper($request->get('nm_tppagamento'));
        $tppagamento->st_avista = ($request->get('st_avista') == 'true') ? '1' : '0';        
        $tppagamento->id_user = Auth::id();
        $tppagamento->created_at = date('Y-m-d H:i:s');
        $tppagamento->save();
        
        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('tppagamento');
    }

    public function show($id)
    {
        $tppagamento = Tppagamento::find($id);        
        return view('tppagamento.show', ['tppagamento'=>$tppagamento]);        
    }

    public function edit($id)
    {
        $tppagamento = Tppagamento::find($id);        
        $action = action('TppagamentoController@update', $tppagamento->id_tppagamento);
        return view("tppagamento.edit",[
            "tppagamento" => $tppagamento,
            "action" => $action,
        ]);        
    }

    public function update(Request $request, $id)
    {        
        $tppagamento = Tppagamento::find($id);
        $tppagamento->nm_tppagamento = strtoupper($request->get('nm_tppagamento'));
        $tppagamento->st_avista = ($request->get('st_avista') == 'true') ? '1' : '0';
        $tppagamento->id_user = Auth::id();
        $tppagamento->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('tppagamento');
    }

    public function destroy(Request $request,$id)
    {
        $tppagamento = Tppagamento::find($id);
        $tppagamento->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
