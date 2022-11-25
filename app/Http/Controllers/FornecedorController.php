<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Fornecedor;
use App\Estado;

class FornecedorController extends Controller
{
    protected $st_tipo = 1; // 0-cliente/1-fornecedor/2-funcionario/3-empresa(corporativo)

    public function index(Request $request)
    {   
        $query=trim($request->get('searchText'));     
        $fornecedor = Fornecedor::select('pessoas.id_pessoa',
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

        return view("fornecedor.index",["fornecedores"=>$fornecedor,"searchText"=>$query]);                                                      
    }

    public function create()
    {
        $estado = Estado::orderBy('nm_sigla','asc')->get();        
        return view("fornecedor.create",['estado'=>$estado]);
    }

    public function store(Request $request)
    {
        $fornecedor = new Fornecedor();
        $fornecedor->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $fornecedor->nm_endereco = strtoupper($request->get('nm_endereco'));
        $fornecedor->nr_numender = strtoupper($request->get('nr_numender'));
        $fornecedor->nm_complender = strtoupper($request->get('nm_complender'));
        $fornecedor->nm_bairro = strtoupper($request->get('nm_bairro'));
        $fornecedor->nm_cidade = strtoupper($request->get('nm_cidade'));
        $fornecedor->nr_cep = $request->get('nr_cep');
        $fornecedor->nm_estado = strtoupper($request->get('nm_estado'));
        $fornecedor->nr_telefone1 = strtoupper($request->get('nr_telefone1'));
        $fornecedor->nr_telefone2 = strtoupper($request->get('nr_telefone2'));
        $fornecedor->nr_telefone3 = strtoupper($request->get('nr_telefone3'));
        $fornecedor->nr_telefone4 = strtoupper($request->get('nr_telefone3'));
        $fornecedor->nm_contato = strtoupper($request->get('nm_contato'));
        $fornecedor->nr_cpfcnpj = $request->get('nr_cpfcnpj');
        $fornecedor->nr_rgie = strtoupper($request->get('nr_rgie'));
        $fornecedor->nm_email = strtoupper($request->get('nm_email'));
        $fornecedor->nm_site = strtoupper($request->get('nm_site'));
        $fornecedor->st_pessoa = '1';
        $fornecedor->st_tipo = $this->st_tipo;
        $fornecedor->nm_obs = strtoupper($request->get('nm_obs')); 
        $fornecedor->id_user = Auth::id();
        $fornecedor->created_at = date('Y-m-d H:i:s');
        $fornecedor->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('fornecedor');
    }

    public function show($id)
    {
        $fornecedor = Fornecedor::find($id);        
        return view('fornecedor.show',['fornecedor'=>$fornecedor]);                     
    }

    public function edit($id)
    {
        $fornecedor = Fornecedor::find($id);
        $estado = Estado::orderBy('nm_sigla','asc')->get();        
        $action = action('FornecedorController@update', $fornecedor->id_pessoa);

        return view("fornecedor.create",[
            'fornecedor'=>$fornecedor,
            'estado'=>$estado,
            'action'=>$action
        ]);        
    }

    public function update(Request $request, $id)
    {
        $fornecedor = Fornecedor::find($id);
        $fornecedor->nm_pessoa = strtoupper($request->get('nm_pessoa'));
        $fornecedor->nm_endereco = strtoupper($request->get('nm_endereco'));
        $fornecedor->nr_numender = strtoupper($request->get('nr_numender'));
        $fornecedor->nm_complender = strtoupper($request->get('nm_complender'));
        $fornecedor->nm_bairro = strtoupper($request->get('nm_bairro'));
        $fornecedor->nm_cidade = strtoupper($request->get('nm_cidade'));
        $fornecedor->nr_cep = $request->get('nr_cep');
        $fornecedor->nm_estado = strtoupper($request->get('nm_estado'));
        $fornecedor->nr_telefone1 = strtoupper($request->get('nr_telefone1'));
        $fornecedor->nr_telefone2 = strtoupper($request->get('nr_telefone2'));
        $fornecedor->nr_telefone3 = strtoupper($request->get('nr_telefone3'));
        $fornecedor->nr_telefone4 = strtoupper($request->get('nr_telefone4'));
        $fornecedor->nm_contato = strtoupper($request->get('nm_contato'));
        $fornecedor->nr_cpfcnpj = $request->get('nr_cpfcnpj');
        $fornecedor->nr_rgie = strtoupper($request->get('nr_rgie'));
        $fornecedor->nm_email = strtoupper($request->get('nm_email'));
        $fornecedor->nm_site = strtoupper($request->get('nm_site'));
        $fornecedor->st_pessoa = '1';
        $fornecedor->st_tipo = $this->st_tipo;
        $fornecedor->nm_obs = strtoupper($request->get('nm_obs')); 
        $fornecedor->id_user = Auth::id();
        $fornecedor->created_at = date('Y-m-d H:i:s');
        $fornecedor->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('fornecedor');
    }

    public function destroy(Request $request,$id)
    {
        $fornecedor = Fornecedor::find($id);
        $fornecedor->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }

    public function autocomplete(Request $request)
    {
        $termo =  $request->get('term');
        $fornecedor = Fornecedor::whereIn('st_tipo',['1','2','3'])
                                ->where(function ($sql) use ($termo) {
                                    $sql->where('nm_pessoa','like','%'.$termo.'%')
                                        ->orWhere('nr_cpfcnpj',$termo);    
                                }) 
                                ->get();

        $data = [];
        foreach ($fornecedor as $key => $value) {
            $data[] = ['id'=>$value->id_pessoa,'label'=>$value->nm_pessoa];
        }
        return response($data);
    }
}
