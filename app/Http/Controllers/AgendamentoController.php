<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Agendamento;

class AgendamentoController extends Controller
{
    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));        
        $agendamento = Agendamento::select('id_agendamento',
                                           'nm_agendamento')
                                ->where('nm_agendamento','LIKE', '%'.$query.'%')
                                ->orWhere('id_agendamento',$query)
                                ->orderBy('nm_agendamento','desc')                                
                                ->paginate(50);

        return view("agendamento.index",["agendamentos"=>$agendamento,"searchText"=>$query]);                                
    }

    public function create()
    {
        return view("agendamento.create");
    }

    public function store(Request $request)
    {       
        $agendamento = new Agendamento();
        $agendamento->nm_agendamento = strtoupper($request->get('nm_agendamento'));
        $agendamento->id_user = Auth::id();
        $agendamento->created_at = date('Y-m-d H:i:s');
        $agendamento->save();
        
        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('agendamento');
    }

    public function show($id)
    {
        $agendamento = Agendamento::find($id);        
        return view('agendamento.show', ['agendamento'=>$agendamento]);        
    }

    public function edit($id)
    {
        $agendamento = Agendamento::find($id); 
        $action = action('AgendamentoController@update', $agendamento->id_agendamento);
        
        return view("agendamento.edit",[
            "agendamento" => $agendamento,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {        
        $agendamento = Agendamento::find($id);
        $agendamento->nm_agendamento = strtoupper($request->get('nm_agendamento'));
        $agendamento->id_user = Auth::id();
        $agendamento->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('agendamento');
    }

    public function destroy(Request $request,$id)
    {
        $agendamento = Agendamento::find($id);
        $agendamento->delete();
        
        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
