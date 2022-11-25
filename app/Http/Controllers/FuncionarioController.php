<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Funcionario;
use App\Estado;
use App\Funcoes;
use Functions;

class FuncionarioController extends Controller
{
    protected $st_tipo = 2; // 0-cliente/1-fornecedor/2-funcionario/3-empresa(corporativo)

    public function index(Request $request)
    {
        $query=trim($request->get('searchText'));
        $funcionario = Funcionario::select('pessoas.id_pessoa',
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
                                           'pessoas.dt_demissao',
                                           'pessoas.nr_pis',
                                           'pessoas.nr_ctps',
                                           'pessoas.id_funcao',
                                           'pessoas.nm_obs',
                                           'pessoas.created_at',
                                           'funcoes.nm_funcao')
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

        return view("funcionario.index",["funcionarios"=>$funcionario,"searchText"=>$query]);
    }

    public function create()
    {
        $estado = Estado::orderBy('nm_sigla','asc')->get();
        $funcao = Funcoes::orderBy('nm_funcao','asc')->get();

        return view("funcionario.create",[
            "estado"=>$estado,
            "funcao"=>$funcao,
        ]);
    }

    public function store(Request $request)
    {
        $funcionario = new Funcionario();
        $funcionario->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $funcionario->nm_endereco = strtoupper($request->get('nm_endereco'));
        $funcionario->nr_numender = strtoupper($request->get('nr_numender'));
        $funcionario->nm_complender = strtoupper($request->get('nm_complender'));
        $funcionario->nm_bairro = strtoupper($request->get('nm_bairro'));
        $funcionario->nm_cidade = strtoupper($request->get('nm_cidade'));
        $funcionario->nr_cep = $request->get('nr_cep');
        $funcionario->nm_estado = strtoupper($request->get('nm_estado'));
        $funcionario->nr_telefone1 = strtoupper($request->get('nr_telefone1'));
        $funcionario->nr_telefone2 = strtoupper($request->get('nr_telefone2'));
        $funcionario->nr_telefone3 = strtoupper($request->get('nr_telefone3'));
        $funcionario->nr_telefone4 = strtoupper($request->get('nr_telefone3'));
        $funcionario->nr_cpfcnpj = $request->get('nr_cpfcnpj');
        $funcionario->nr_rgie = strtoupper($request->get('nr_rgie'));
        $funcionario->nm_email = strtoupper($request->get('nm_email'));
        $funcionario->vl_comprod = $request->get('vl_comprod');
        $funcionario->vl_comserv = $request->get('vl_comserv');
        $funcionario->st_comcob = $request->get('st_comcob') !== null ? '1' : '0';
        $funcionario->vl_salario = $request->get('vl_salario');
        $funcionario->dt_admissao = Functions::DateToEua($request->get('dt_admissao'));
        $funcionario->dt_demissao = Functions::DateToEua($request->get('dt_demissao'));
        $funcionario->nr_pis = $request->get('nr_pis');
        $funcionario->nr_ctps = $request->get('nr_ctps');
        $funcionario->id_funcao = $request->get('id_funcao');
        $funcionario->st_pessoa = '0';
        $funcionario->st_tipo = $this->st_tipo;
        $funcionario->nm_obs = strtoupper($request->get('nm_obs')); 
        $funcionario->id_user = Auth::id();
        $funcionario->created_at = date('Y-m-d H:i:s');
        $funcionario->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('funcionario');
    }

    public function show($id)
    {        
        $funcionario = Funcionario::select('pessoas.id_pessoa',
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
                                           'pessoas.dt_demissao',
                                           'pessoas.nr_pis',
                                           'pessoas.nr_ctps',
                                           'pessoas.id_funcao',
                                           'pessoas.nm_obs',
                                           'pessoas.created_at',
                                           'funcoes.nm_funcao')
                                  ->leftJoin('estcivils', 'pessoas.id_estcivil', '=', 'estcivils.id_estcivil')
                                  ->leftJoin('religiaos', 'pessoas.id_religiao', '=', 'religiaos.id_religiao')
                                  ->leftJoin('funcoes', 'pessoas.id_funcao', '=', 'funcoes.id_funcao')
                                  ->where('id_pessoa',$id)
                                  ->first();

        return view('funcionario.show', ['funcionario'=>$funcionario]);        
    }

    public function edit($id)
    {        
        $funcionario = Funcionario::find($id);
        $estado = Estado::orderBy('nm_sigla','asc')->get();
        $funcao = Funcoes::orderBy('nm_funcao','asc')->get();
        $action = action('FuncionarioController@update', $funcionario->id_pessoa);

        return view("funcionario.edit",[
            "funcionario" => $funcionario,
            "estado" => $estado,
            "funcao" => $funcao,
            "action" => $action,
        ]);        
    }

    public function update(Request $request, $id)
    {               
        $funcionario = Funcionario::find($id);
        $funcionario->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $funcionario->nm_endereco = strtoupper($request->get('nm_endereco'));
        $funcionario->nr_numender = strtoupper($request->get('nr_numender'));
        $funcionario->nm_complender = strtoupper($request->get('nm_complender'));
        $funcionario->nm_bairro = strtoupper($request->get('nm_bairro'));
        $funcionario->nm_cidade = strtoupper($request->get('nm_cidade'));
        $funcionario->nr_cep = $request->get('nr_cep');
        $funcionario->nm_estado = strtoupper($request->get('nm_estado'));
        $funcionario->nr_telefone1 = strtoupper($request->get('nr_telefone1'));
        $funcionario->nr_telefone2 = strtoupper($request->get('nr_telefone2'));
        $funcionario->nr_telefone3 = strtoupper($request->get('nr_telefone3'));
        $funcionario->nr_telefone4 = strtoupper($request->get('nr_telefone3'));
        $funcionario->nr_cpfcnpj = $request->get('nr_cpfcnpj');
        $funcionario->nr_rgie = strtoupper($request->get('nr_rgie'));
        $funcionario->nm_email = strtoupper($request->get('nm_email'));
        $funcionario->vl_comprod = $request->get('vl_comprod');
        $funcionario->vl_comserv = $request->get('vl_comserv');
        $funcionario->st_comcob = $request->get('st_comcob') !== null ? '1' : '0';
        $funcionario->vl_salario = $request->get('vl_salario');
        $funcionario->dt_admissao = Functions::DateToEua($request->get('dt_admissao'));
        $funcionario->dt_demissao = Functions::DateToEua($request->get('dt_demissao'));
        $funcionario->nr_pis = $request->get('nr_pis');
        $funcionario->nr_ctps = $request->get('nr_ctps');
        $funcionario->id_funcao = $request->get('id_funcao');
        $funcionario->st_pessoa = '0';
        $funcionario->st_tipo = $this->st_tipo;
        $funcionario->nm_obs = strtoupper($request->get('nm_obs')); 
        $funcionario->id_user = Auth::id();
        $funcionario->created_at = date('Y-m-d H:i:s');
        $funcionario->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('funcionario');
    }

    public function destroy(Request $request,$id)
    {
        $funcionario = Funcionario::find($id);
        $funcionario->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
