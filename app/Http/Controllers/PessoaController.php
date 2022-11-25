<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Pessoa;

class PessoaController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function autocomplete(Request $request)
    {
        $termo =  $request->get('term');
        $pessoa = Pessoa::where('nm_pessoa','like','%'.$termo.'%')
                        ->orWhere('nr_cpfcnpj',$termo)
                        ->get();

        $data = [];
        foreach ($pessoa as $key => $value) {
            $data[] = ['id'=>$value->id_pessoa,'label'=>$value->nm_pessoa];
        }
        return response($data);
    }

}
