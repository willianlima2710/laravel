<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Contratodep;

class ContratodepController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }   

    public function show(Request $request)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    public function autocomplete(Request $request)
    {
        $termo =  $request->get('term');
        $contratodep = Contratodep::select('id_contratodep',
                                           'nm_dependente',
                                           'nr_contrato',
                                           'nr_cpf')                    
                                  ->where(function ($sql) use ($termo) {            
                                        $sql->where('nm_dependente','like','%'.$termo.'%')
                                            ->orWhere('nr_cpf',$termo)
                                            ->orWhere('nr_contrato',$termo);
                                  }) 
                                  ->get();

        $data = [];
        foreach ($contratodep as $key => $value) {
            $data[] = ['id'=>$value->id_contratodep,'label'=>$value->nm_dependente,'contrato'=>$value->nr_contrato];
        }
        return response($data);
    }
}
