<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Protocolo;
use Functions;

class ProtocoloController extends Controller
{    
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));
        $protocolo = Protocolo::select('protocolos.id_protocolo',
                                       'protocolos.nr_protocolo',
                                       'protocolos.id_pessoa',
                                       'protocolos.cd_pessoa',
                                       'protocolos.nm_pessoa',
                                       'protocolos.nm_protocolo',
                                       'protocolos.dt_protocolo',
                                       'protocolos.hr_protocolo',                                       
                                       )
                              ->where('protocolos.nm_protocolo','LIKE', '%'.$query.'%')
                              ->orWhere('protocolos.nr_protocolo',$query)
                              ->orderBy('protocolos.dt_protocolo','desc')                                
                              ->paginate(50);

        return view("protocolo.index",["protocolos"=>$protocolo,"searchText"=>$query]);                                
    }

    public function create()
    {
        return view("protocolo.create");
    }

    public function store(Request $request)
    {
        $protocolo = new Protocolo();
        $protocolo->nr_protocolo = strtoupper($request->get('nr_protocolo'));
        $protocolo->id_pessoa = $request->get('id_pessoa');
        $protocolo->cd_pessoa = strtoupper($request->get('cd_pessoa'));
        $protocolo->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $protocolo->nm_protocolo = strtoupper($request->get('nm_protocolo'));
        $protocolo->dt_protocolo = Functions::DateToEua($request->get('dt_protocolo'));
        $protocolo->nr_protocolo = $request->get('nr_protocolo');
        $protocolo->id_user = Auth::id();
        $protocolo->created_at = date('Y-m-d H:i:s');
        $protocolo->save();
        
        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('protocolo');
    }

    public function show($id)
    {
        $protocolo = Protocolo::select('protocolos.id_protocolo',
                                       'protocolos.nr_protocolo',
                                       'protocolos.id_pessoa',
                                       'protocolos.cd_pessoa',
                                       'protocolos.nm_pessoa',
                                       'protocolos.nm_protocolo',
                                       'protocolos.dt_protocolo',
                                       'protocolos.hr_protocolo',                                       
                                       )
                              ->Where('protocolos.id_protocolo',$id)
                              ->orderBy('protocolos.dt_protocolo','desc')
                              ->get();                                       

        return view('protocolo.show', ['protocolo'=>$protocolo]);                              
    }

    public function edit($id)
    {
        $protocolo = Protocolo::select('protocolos.id_protocolo',
                                       'protocolos.nr_protocolo',
                                       'protocolos.id_pessoa',
                                       'protocolos.cd_pessoa',
                                       'protocolos.nm_pessoa',
                                       'protocolos.nm_protocolo',
                                       'protocolos.dt_protocolo',
                                       'protocolos.hr_protocolo',                                       
                                       )
                              ->Where('protocolos.id_protocolo',$id)
                              ->orderBy('protocolos.dt_protocolo','desc')
                              ->get();                                       
        $action = action('ProtocoloController@update', $protocolo->id_protocolo);

        return view("protocolo.edit",[
            "protocolo" => $protocolo,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {
        $protocolo = Protocolo::find($id);
        $protocolo->nr_protocolo = strtoupper($request->get('nr_protocolo'));
        $protocolo->id_pessoa = $request->get('id_pessoa');
        $protocolo->cd_pessoa = strtoupper($request->get('cd_pessoa'));
        $protocolo->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $protocolo->nm_protocolo = strtoupper($request->get('nm_protocolo'));
        $protocolo->dt_protocolo = Functions::DateToEua($request->get('dt_protocolo'));
        $protocolo->nr_protocolo = $request->get('nr_protocolo');
        $protocolo->id_user = Auth::id();
        $protocolo->created_at = date('Y-m-d H:i:s');
        $protocolo->save();
        
        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('protocolo');
    }

    public function destroy(Request $request,$id)
    {
        $protocolo = Protocolo::find($id);
        $protocolo->delete();
        
        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
