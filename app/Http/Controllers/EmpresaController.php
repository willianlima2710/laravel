<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Empresa;
use App\Estado;

class EmpresaController extends Controller
{
    protected $st_tipo = 3; // 0-cliente/1-fornecedor/2-funcionario/3-empresa(corporativo)

    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));
        $empresa = Empresa::select('pessoas.id_pessoa',
                                   'pessoas.cd_pessoa',    
                                   'pessoas.nm_pessoa',
                                   'pessoas.nm_endereco',
                                   'pessoas.nr_numender',
                                   'pessoas.nm_bairro',
                                   'pessoas.nm_complender',
                                   'pessoas.nm_cidade',
                                   'pessoas.nr_cep',
                                   'pessoas.nm_estado',
                                   'pessoas.nr_telefone1',
                                   'pessoas.nr_telefone2',
                                   'pessoas.nr_telefone3',
                                   'pessoas.nr_telefone4',
                                   'pessoas.nm_pai',
                                   'pessoas.nr_paitelefone',
                                   'pessoas.st_paivivo',
                                   'pessoas.nm_mae',
                                   'pessoas.nr_maetelefone',
                                   'pessoas.st_maeviva',
                                   'pessoas.nm_conjuge',    
                                   'pessoas.nr_conjugetelefone',
                                   'pessoas.nr_cpfcnpj',
                                   'pessoas.nr_rgie',
                                   'pessoas.nm_email',
                                   'pessoas.nm_site',
                                   'pessoas.nm_profissao',
                                   'pessoas.id_estcivil',
                                   'pessoas.dt_nascimento',
                                   'pessoas.id_religiao',
                                   'pessoas.nm_nacionalidade',
                                   'pessoas.nm_naturalidade',
                                   'pessoas.st_sexo',
                                   'pessoas.st_pessoa',
                                   'pessoas.st_tipo',
                                   'pessoas.nm_contato',
                                   'pessoas.vl_comprod',
                                   'pessoas.vl_comserv',
                                   'pessoas.st_comcob',
                                   'pessoas.vl_salario',
                                   'pessoas.dt_admissao',
                                   'pessoas.nr_pis',
                                   'pessoas.nr_ctps',
                                   'pessoas.id_funcao',
                                   'pessoas.nm_obs',
                                   'pessoas.created_at')
                          ->leftJoin('estcivils', 'pessoas.id_estcivil', '=', 'estcivils.id_estcivil')
                          ->leftJoin('religiaos', 'pessoas.id_religiao', '=', 'religiaos.id_religiao')
                          ->leftJoin('funcoes', 'pessoas.id_funcao', '=', 'funcoes.id_funcao')
                          ->where('st_tipo',$this->st_tipo)
                          ->where(function ($sql) use ($query) {
                              $sql->Where('pessoas.nm_pessoa','LIKE', '%'.$query.'%')
                                  ->orWhere('pessoas.cd_pessoa',$query)
                                  ->orWhere('pessoas.nr_cpfcnpj',$query);  
                            })    
                          ->orderBy('pessoas.created_at','desc')                                
                          ->paginate(50);

        return view("empresa.index",["empresas"=>$empresa,"searchText"=>$query]);                                       
    }
    
    public function create()
    {
        $estado = Estado::orderBy('nm_sigla','asc')->get();

        return view("empresa.create",[
            "estado"=>$estado,
        ]);        
    }

    public function store(Request $request)
    {
        $empresa = new Empresa();
        $empresa->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $empresa->nm_endereco = strtoupper($request->get('nm_endereco'));
        $empresa->nr_numender = strtoupper($request->get('nr_numender'));
        $empresa->nm_complender = strtoupper($request->get('nm_complender'));
        $empresa->nm_bairro = strtoupper($request->get('nm_bairro'));
        $empresa->nm_cidade = strtoupper($request->get('nm_cidade'));
        $empresa->nr_cep = $request->get('nr_cep');
        $empresa->nm_estado = strtoupper($request->get('nm_estado'));
        $empresa->nr_telefone1 = strtoupper($request->get('nr_telefone1'));
        $empresa->nr_telefone2 = strtoupper($request->get('nr_telefone2'));
        $empresa->nr_telefone3 = strtoupper($request->get('nr_telefone4'));
        $empresa->nr_telefone4 = strtoupper($request->get('nr_telefone3'));
        $empresa->nr_cpfcnpj = $request->get('nr_cpfcnpj');
        $empresa->nr_rgie = strtoupper($request->get('nr_rgie'));
        $empresa->nm_email = strtoupper($request->get('nm_email'));
        $empresa->nm_site = strtoupper($request->get('nm_site'));
        $empresa->st_pessoa = '1';
        $empresa->st_tipo = $this->st_tipo;
        $empresa->nm_obs = strtoupper($request->get('nm_obs')); 
        $empresa->id_user = Auth::id();
        $empresa->created_at = date('Y-m-d H:i:s');
        $empresa->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('empresa');
    }

    public function show($id)
    {
        $empresa = Empresa::find($id);        
        return view('empresa.show', ['empresa'=>$empresa]);        
    }

    public function edit($id)
    {
        $empresa = Empresa::find($id);
        $estado = Estado::orderBy('nm_sigla','asc')->get();
        $action = action('EmpresaController@update', $empresa->id_pessoa);

        return view("empresa.edit",[
            "empresa" => $empresa,
            "estado" => $estado,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);
        $empresa->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $empresa->nm_endereco = strtoupper($request->get('nm_endereco'));
        $empresa->nr_numender = strtoupper($request->get('nr_numender'));
        $empresa->nm_complender = strtoupper($request->get('nm_complender'));
        $empresa->nm_bairro = strtoupper($request->get('nm_bairro'));
        $empresa->nm_cidade = strtoupper($request->get('nm_cidade'));
        $empresa->nr_cep = $request->get('nr_cep');
        $empresa->nm_estado = strtoupper($request->get('nm_estado'));
        $empresa->nr_telefone1 = strtoupper($request->get('nr_telefone1'));
        $empresa->nr_telefone2 = strtoupper($request->get('nr_telefone2'));
        $empresa->nr_telefone3 = strtoupper($request->get('nr_telefone4'));
        $empresa->nr_telefone4 = strtoupper($request->get('nr_telefone3'));    
        $empresa->nr_cpfcnpj = $request->get('nr_cpfcnpj');
        $empresa->nr_rgie = strtoupper($request->get('nr_rgie'));
        $empresa->nm_email = strtoupper($request->get('nm_email'));
        $empresa->nm_site = strtoupper($request->get('nm_site'));
        $empresa->st_pessoa = '1';
        $empresa->st_tipo = $this->st_tipo;
        $empresa->nm_obs = strtoupper($request->get('nm_obs')); 
        $empresa->id_user = Auth::id();
        $empresa->created_at = date('Y-m-d H:i:s');
        $empresa->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('empresa');
    }

    public function destroy(Request $request, $id)
    {
        $empresa = Empresa::find($id);
        $empresa->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
