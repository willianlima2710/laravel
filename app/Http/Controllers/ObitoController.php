<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Obito;
use App\Estcivil;
use App\Estado;
use App\Cemiterio;
use App\Tppagamento;
use App\Capela;
use App\Funeraria;
use App\Contratodep;
use DB;
use Functions;

class ObitoController extends Controller
{    
    public function index(Request $request)
    { 
        $query=trim($request->get('searchText'));        
        $obito = Obito::select('obitos.id_obito',
                               'obitos.nr_declaracao',
                               'obitos.id_dependente',
                               'obitos.nm_dependente',
                               'obitos.dt_nascimento',
                               'obitos.st_sexo',                               
                               'obitos.nm_cor',                               
                               'obitos.nr_cpfcnpj',                               
                               'obitos.nr_rgie',                               
                               'obitos.nm_profissao',                               
                               'obitos.nr_telefone1',
                               'obitos.nr_telefone2',
                               'obitos.nm_nacionalidade',                               
                               'obitos.nm_naturalidade',                               
                               'obitos.id_estcivil',                               
                               'obitos.nm_endereco',                               
                               'obitos.nr_numender',                               
                               'obitos.nm_complender',                               
                               'obitos.nm_bairro',
                               'obitos.nm_cidade',
                               'obitos.nm_estado',
                               'obitos.st_bens',                               
                               'obitos.st_testamento',                               
                               'obitos.st_reservista',                               
                               'obitos.st_eleitor',                               
                               'obitos.nm_pai',                               
                               'obitos.nm_mae',                               
                               'obitos.nr_contrato',                               
                               'obitos.dt_falecimento',                               
                               'obitos.hr_falecimento',                               
                               'obitos.ds_falecimento',                               
                               'obitos.dt_sepultamento',                               
                               'obitos.hr_sepultamento',                               
                               'obitos.id_cemiterio',                               
                               'obitos.id_tppagamentocm',
                               'obitos.vl_despesacm',
                               'obitos.nr_chequecm',
                               'obitos.id_funeraria',
                               'obitos.id_tppagamentofn',
                               'obitos.vl_despesafn',
                               'obitos.nr_chequefn',
                               'obitos.id_capela',
                               'obitos.id_tppagamentocp',
                               'obitos.vl_despesacp',
                               'obitos.nr_chequecp',
                               'obitos.ds_velorio',
                               'obitos.st_declaobito',
                               'obitos.st_tanatopraxia',
                               'obitos.st_translado',                               
                               'obitos.st_notafaleci',                               
                               'obitos.nm_medico',                               
                               'obitos.nr_crm',                               
                               'obitos.nm_causamorte',                               
                               'obitos.dt_atendimento',                               
                               'obitos.hr_atendimento',                               
                               'obitos.nm_obs'
                               )
                      ->where('nm_dependente','LIKE', '%'.$query.'%')
                      ->orWhere('nr_declaracao',$query)
                      ->orWhere('nr_contrato',$query)
                      ->orderBy('nm_dependente','desc')                                
                      ->paginate(50);

        return view("obito.index",["obitos"=>$obito,"searchText"=>$query]);
    }

    public function create()
    {
        $estcivil = Estcivil::orderBy('nm_estcivil','asc')->get();
        $estado = Estado::orderBy('nm_sigla','asc')->get();
        $cemiterio = Cemiterio::orderBy('nm_cemiterio','asc')->get();
        $tppagamentofn = Tppagamento::orderBy('nm_tppagamento','asc')->get();
        $tppagamentocp = Tppagamento::orderBy('nm_tppagamento','asc')->get();
        $tppagamentocm = Tppagamento::orderBy('nm_tppagamento','asc')->get();
        $capela = Capela::orderBy('nm_capela','asc')->get();
        $funeraria = Funeraria::orderBy('nm_funeraria','asc')->get();

        $sexo = [
            0 => [
                    'st_sexo'=> 0,
                    'nm_sexo'=> 'MASCULINO',
                 ],
            1 => [
                    'st_sexo'=> 1,
                    'nm_sexo'=> 'FEMININO',
                 ],        
        ];

        return view("obito.create",[
            "estcivils"=>$estcivil,
            "estados"=>$estado,
            "sexos"=>$sexo,    
            "cemiterios"=>$cemiterio,
            "tppagamentosfn" => $tppagamentofn,
            "tppagamentoscp" => $tppagamentocp,
            "tppagamentoscm" => $tppagamentocm,
            "capelas" => $capela,
            "funerarias" => $funeraria,
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {            
            $obito = new Obito();
            $obito->nr_declaracao = strtoupper($request->get('nr_declaracao'));
            $obito->id_dependente = $request->get('id_dependente');
            $obito->nm_dependente = strtoupper($request->get('nm_dependente'));
            $obito->dt_nascimento = Functions::DateToEua($request->get('dt_nascimento'));
            $obito->st_sexo = $request->get('st_sexo');
            $obito->nm_cor = strtoupper($request->get('nm_cor'));
            $obito->nr_cpfcnpj = $request->get('nr_cpfcnpj');
            $obito->nr_rgie = $request->get('nr_rgie');
            $obito->nm_profissao = strtoupper($request->get('nm_profissao'));
            $obito->nr_telefone1 = $request->get('nr_telefone1');
            $obito->nr_telefone2 = $request->get('nr_telefone2');        
            $obito->nm_nacionalidade = strtoupper($request->get('nm_nacionalidade'));
            $obito->nm_naturalidade = strtoupper($request->get('nm_naturalidade'));
            $obito->id_estcivil = $request->get('id_estcivil');
            $obito->nm_endereco = strtoupper($request->get('nm_endereco'));
            $obito->nr_numender = $request->get('nr_numender');
            $obito->nm_complender = strtoupper($request->get('nm_complender'));
            $obito->nm_bairro = strtoupper($request->get('nm_bairro'));
            $obito->nm_cidade = strtoupper($request->get('nm_cidade'));
            $obito->nm_estado = strtoupper($request->get('nm_estado'));
            $obito->st_bens = $request->get('st_bens') !== null ? 1 : 0;
            $obito->st_testamento = $request->get('st_testamento') !== null ? 1 : 0;
            $obito->st_reservista = $request->get('st_reservista') !== null ? 1 : 0;
            $obito->st_eleitor = $request->get('st_eleitor') !== null ? 1 : 0;
            $obito->nm_pai = strtoupper($request->get('nm_pai'));
            $obito->nm_mae = strtoupper($request->get('nm_mae'));
            $obito->nr_contrato = $request->get('nr_contrato');
            $obito->dt_falecimento = Functions::DateToEua($request->get('dt_falecimento'));
            $obito->hr_falecimento = strtoupper($request->get('hr_falecimento'));
            $obito->ds_falecimento = strtoupper($request->get('ds_falecimento'));
            $obito->dt_sepultamento = Functions::DateToEua($request->get('dt_sepultamento'));
            $obito->hr_sepultamento = $request->get('hr_sepultamento');
            $obito->id_cemiterio = $request->get('id_cemiterio');
            $obito->id_tppagamentocm = $request->get('id_tppagamentocm');
            $obito->vl_despesacm = $request->get('vl_despesacm');
            $obito->nr_chequecm = $request->get('nr_chequecm');
            $obito->id_funeraria = $request->get('id_funeraria');
            $obito->id_tppagamentofn = $request->get('id_tppagamentofn');
            $obito->vl_despesafn = $request->get('vl_despesafn');
            $obito->nr_chequefn = $request->get('nr_chequefn');
            $obito->id_capela = $request->get('id_capela');
            $obito->id_tppagamentocp = $request->get('id_tppagamentocp');
            $obito->vl_despesacp = $request->get('vl_despesacp');
            $obito->nr_chequecp = $request->get('nr_chequecp');
            $obito->ds_velorio = strtoupper($request->get('ds_velorio'));
            $obito->st_declaobito = $request->get('st_declaobito') !== null ? 1 : 0;
            $obito->st_tanatopraxia = $request->get('st_tanatopraxia') !== null ? 1 : 0;
            $obito->st_translado = $request->get('st_translado') !== null ? 1 : 0;
            $obito->st_notafaleci = $request->get('st_notafaleci') !== null ? 1 : 0;
            $obito->nm_medico = strtoupper($request->get('nm_medico'));
            $obito->nr_crm = strtoupper($request->get('nr_crm'));
            $obito->nm_causamorte = strtoupper($request->get('nm_causamorte'));
            $obito->dt_atendimento = Functions::DateToEua($request->get('dt_atendimento'));
            $obito->hr_atendimento = $request->get('hr_atendimento');
            $obito->nm_obs = strtoupper($request->get('nm_obs')); 
            $obito->id_user = Auth::id();
            $obito->created_at = date('Y-m-d H:i:s');
            $obito->save();

            //-- atualiza o dependente no contrato
            $contratodep = Contratodep::find($request->get('id_dependente'));
            $contratodep->id_cemiterio = $request->get('id_cemiterio');
            $contratodep->id_funeraria = strtoupper($request->get('id_funeraria'));
            $contratodep->nr_contrato = $request->get('nr_contrato');
            $contratodep->nr_telefone1 = $request->get('nr_telefone1');
            $contratodep->nr_telefone2 = $request->get('nr_telefone2');
            $contratodep->id_estcivil =  $request->get('id_estcivil');
            $contratodep->st_sexo = $request->get('st_sexo');
            $contratodep->dt_nascimento = Functions::DateToEua($request->get('dt_nascimento'));
            $contratodep->nr_idade = Functions::CalculaIdade($request->get('dt_nascimento'));
            $contratodep->nr_cpf = $request->get('nr_cpfcnpj');
            $contratodep->nr_rg = $request->get('nr_rgie');
            $contratodep->st_status = '1';
            $contratodep->dt_falecimento = Functions::DateToEua($request->get('dt_falecimento'));
            $contratodep->dt_sepultamento = Functions::DateToEua($request->get('dt_sepultamento'));
            $contratodep->st_atendido = 1;
            $contratodep->id_obito = $obito->id_obito;
            $contratodep->nm_obs = strtoupper($request->get('nm_obs'));
            $contratodep->id_user = Auth::id();
            $contratodep->created_at = date('Y-m-d H:i:s');
            $contratodep->save();

            DB::commit();    
            $request->session()->flash('alert-success', 'Adicionado com sucesso!');
            return Redirect::to('obito');
        }catch(Exception $e) {
            DB::rollback();
            throw $e;
        }    
        return json_encode($obito);          
    }

    public function show($id)
    {
        $obito = Obito::find($id);
        return view('obito.show', ['obito'=>$obito]);        
    }

    public function edit($id)
    {
        $obito = Obito::find($id);        
        $estcivil = Estcivil::orderBy('nm_estcivil','asc')->get();
        $estado = Estado::orderBy('nm_sigla','asc')->get();
        $cemiterio = Cemiterio::orderBy('nm_cemiterio','asc')->get();
        $tppagamentofn = Tppagamento::orderBy('nm_tppagamento','asc')->get();
        $tppagamentocp = Tppagamento::orderBy('nm_tppagamento','asc')->get();
        $tppagamentocm = Tppagamento::orderBy('nm_tppagamento','asc')->get();
        $capela = Capela::orderBy('nm_capela','asc')->get();
        $funeraria = Funeraria::orderBy('nm_funeraria','asc')->get();
        $action = action('ObitoController@update', $obito->id_obito);

        $sexo = [
            0 => [
                    'st_sexo'=> 0,
                    'nm_sexo'=> 'MASCULINO',
                 ],
            1 => [
                    'st_sexo'=> 1,
                    'nm_sexo'=> 'FEMININO',
                 ],        
        ];

        return view("obito.edit",[
            "obito" => $obito,
            "estcivils"=>$estcivil,
            "estados"=>$estado,
            "sexos"=>$sexo,    
            "cemiterios"=>$cemiterio,
            "tppagamentosfn" => $tppagamentofn,
            "tppagamentoscp" => $tppagamentocp,
            "tppagamentoscm" => $tppagamentocm,
            "capelas" => $capela,
            "funerarias" => $funeraria,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        
        try {            
            $obito = Obito::find($id);
            $obito->nr_declaracao = strtoupper($request->get('nr_declaracao'));
            $obito->id_dependente = $request->get('id_dependente');
            $obito->nm_dependente = strtoupper($request->get('nm_dependente'));
            $obito->dt_nascimento = Functions::DateToEua($request->get('dt_nascimento'));
            $obito->st_sexo = $request->get('st_sexo');
            $obito->nm_cor = strtoupper($request->get('nm_cor'));
            $obito->nr_cpfcnpj = $request->get('nr_cpfcnpj');
            $obito->nr_rgie = $request->get('nr_rgie');
            $obito->nm_profissao = strtoupper($request->get('nm_profissao'));
            $obito->nr_telefone1 = $request->get('nr_telefone1');
            $obito->nr_telefone2 = $request->get('nr_telefone2');        
            $obito->nm_nacionalidade = strtoupper($request->get('nm_nacionalidade'));
            $obito->nm_naturalidade = strtoupper($request->get('nm_naturalidade'));
            $obito->id_estcivil = $request->get('id_estcivil');
            $obito->nm_endereco = strtoupper($request->get('nm_endereco'));
            $obito->nr_numender = $request->get('nr_numender');
            $obito->nm_complender = strtoupper($request->get('nm_complender'));
            $obito->nm_bairro = strtoupper($request->get('nm_bairro'));
            $obito->nm_cidade = strtoupper($request->get('nm_cidade'));
            $obito->nm_estado = strtoupper($request->get('nm_estado'));
            $obito->st_bens = $request->get('st_bens') !== null ? 1 : 0;
            $obito->st_testamento = $request->get('st_testamento') !== null ? 1 : 0;
            $obito->st_reservista = $request->get('st_reservista') !== null ? 1 : 0;
            $obito->st_eleitor = $request->get('st_eleitor') !== null ? 1 : 0;
            $obito->nm_pai = strtoupper($request->get('nm_pai'));
            $obito->nm_mae = strtoupper($request->get('nm_mae'));
            $obito->nr_contrato = $request->get('nr_contrato');
            $obito->dt_falecimento = Functions::DateToEua($request->get('dt_falecimento'));
            $obito->hr_falecimento = strtoupper($request->get('hr_falecimento'));
            $obito->ds_falecimento = strtoupper($request->get('ds_falecimento'));
            $obito->dt_sepultamento = Functions::DateToEua($request->get('dt_sepultamento'));
            $obito->hr_sepultamento = $request->get('hr_sepultamento');
            $obito->id_cemiterio = $request->get('id_cemiterio');
            $obito->id_tppagamentocm = $request->get('id_tppagamentocm');
            $obito->vl_despesacm = $request->get('vl_despesacm');
            $obito->nr_chequecm = $request->get('nr_chequecm');
            $obito->id_funeraria = $request->get('id_funeraria');
            $obito->id_tppagamentofn = $request->get('id_tppagamentofn');
            $obito->vl_despesafn = $request->get('vl_despesafn');
            $obito->nr_chequefn = $request->get('nr_chequefn');
            $obito->id_capela = $request->get('id_capela');
            $obito->id_tppagamentocp = $request->get('id_tppagamentocp');
            $obito->vl_despesacp = $request->get('vl_despesacp');
            $obito->nr_chequecp = $request->get('nr_chequecp');
            $obito->ds_velorio = strtoupper($request->get('ds_velorio'));
            $obito->st_declaobito = $request->get('st_declaobito') !== null ? 1 : 0;
            $obito->st_tanatopraxia = $request->get('st_tanatopraxia') !== null ? 1 : 0;
            $obito->st_translado = $request->get('st_translado') !== null ? 1 : 0;
            $obito->st_notafaleci = $request->get('st_notafaleci') !== null ? 1 : 0;
            $obito->nm_medico = strtoupper($request->get('nm_medico'));
            $obito->nr_crm = strtoupper($request->get('nr_crm'));
            $obito->nm_causamorte = strtoupper($request->get('nm_causamorte'));
            $obito->dt_atendimento = Functions::DateToEua($request->get('dt_atendimento'));
            $obito->hr_atendimento = $request->get('hr_atendimento');
            $obito->nm_obs = strtoupper($request->get('nm_obs')); 
            $obito->id_user = Auth::id();
            $obito->created_at = date('Y-m-d H:i:s');
            $obito->save();

            //-- atualiza o dependente no contrato
            $contratodep = Contratodep::find($request->get('id_dependente'));
            $contratodep->id_cemiterio = $request->get('id_cemiterio');
            $contratodep->id_funeraria = strtoupper($request->get('id_funeraria'));
            $contratodep->nr_contrato = $request->get('nr_contrato');
            $contratodep->nr_telefone1 = $request->get('nr_telefone1');
            $contratodep->nr_telefone2 = $request->get('nr_telefone2');
            $contratodep->id_estcivil =  $request->get('id_estcivil');
            $contratodep->st_sexo = $request->get('st_sexo');
            $contratodep->dt_nascimento = Functions::DateToEua($request->get('dt_nascimento'));
            $contratodep->nr_idade = Functions::CalculaIdade($request->get('dt_nascimento'));
            $contratodep->nr_cpf = $request->get('nr_cpfcnpj');
            $contratodep->nr_rg = $request->get('nr_rgie');
            $contratodep->st_status = '1';
            $contratodep->dt_falecimento = Functions::DateToEua($request->get('dt_falecimento'));
            $contratodep->dt_sepultamento = Functions::DateToEua($request->get('dt_sepultamento'));
            $contratodep->st_atendido = 1;
            $contratodep->id_obito = $obito->id_obito;
            $contratodep->nm_obs = strtoupper($request->get('nm_obs'));
            $contratodep->id_user = Auth::id();
            $contratodep->created_at = date('Y-m-d H:i:s');
            $contratodep->save();

            DB::commit();    
            $request->session()->flash('alert-success', 'Alterado com sucesso!');
            return Redirect::to('obito');
        }catch(Exception $e) {
            DB::rollback();
            throw $e;
        }    
        return json_encode($obito);          
    }

    public function destroy(Request $request,$id)
    {
        $obito = Obito::find($id);
        $obito->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
