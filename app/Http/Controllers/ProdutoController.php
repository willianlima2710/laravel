<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Produto;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {        
        $query=trim($request->get('searchText'));
        $produto = Produto::select('produtos.id_produto',
                                   'produtos.nm_produto',
                                   'produtos.id_fornecedor',
                                   'produtos.nm_fornecedor',
                                   'produtos.vl_compra',
                                   'produtos.vl_venda',
                                   'produtos.cd_unidade',
                                   'produtos.qt_estoque',
                                   'produtos.qt_minestoque',
                                   'produtos.cd_barra',
                                   'produtos.st_convalescente',
                                   'produtos.nm_obs')                            
                            ->where('produtos.nm_produto','LIKE', '%'.$query.'%')
                            ->orWhere('produtos.id_produto',$query)
                            ->orderBy('produtos.nm_produto','desc')                                
                            ->paginate(50);

        return view("produto.index",["produtos"=>$produto,"searchText"=>$query]);                                                            
    }

    public function create()
    {
        $unidade = [
            0 => [
                'cd_unidade'=> 'UN',
                'nm_unidade'=> 'UNIDADE',
                ],
            1 => [
                'cd_unidade'=> 'KIT',
                'nm_unidade'=> 'KIT',
                ],        
            2 => [
                 'cd_unidade'=> 'KG',
                 'nm_unidade'=> 'KILO',
                ],            
        ];

        return view("produto.create",[
            'unidades'=>$unidade,
        ]);
    }

    public function store(Request $request)
    {
        $produto = new Produto();
        $produto->nm_produto = strtoupper($request->get('nm_produto'));
        $produto->id_fornecedor = $request->get('id_fornecedor');
        $produto->nm_fornecedor = strtoupper($request->get('nm_fornecedor'));
        $produto->vl_compra = $request->get('vl_compra');
        $produto->vl_venda = $request->get('vl_venda');    
        $produto->cd_unidade = strtoupper($request->get('cd_unidade'));    
        $produto->qt_estoque = $request->get('qt_estoque');    
        $produto->qt_minestoque = $request->get('qt_minestoque');    
        $produto->cd_barra = strtoupper($request->get('cd_barra'));    
        $produto->st_convalescente = $request->get('st_convalescente') !== null ? '1' : '0';
        $produto->nm_obs = strtoupper($request->get('nm_obs'));    
        $produto->id_user = Auth::id();
        $produto->created_at = date('Y-m-d H:i:s');
        $produto->save();

        $request->session()->flash('alert-success', 'Adicionado com sucesso!');
        return Redirect::to('produto');
    }

    public function show($id)
    {
        $produto = Produto::select('produtos.id_produto',
                                   'produtos.nm_produto',
                                   'produtos.id_fornecedor',
                                   'produtos.vl_compra',
                                   'produtos.vl_venda',
                                   'produtos.cd_unidade',
                                   'produtos.qt_estoque',
                                   'produtos.qt_minestoque',
                                   'produtos.cd_barra',
                                   'produtos.st_convalescente',
                                   'produtos.nm_obs',
                                   'pessoas.nm_pessoa')
                            ->leftJoin('pessoas', 'produtos.id_fornecedor', '=', 'pessoas.id_pessoa')
                            ->where('produtos.id_produto',$id)
                            ->first();
        
        return view('produto.show', ['produto'=>$produto]);                                    
    }

    public function edit($id)
    {                
        $produto = Produto::select('produtos.id_produto',
                                   'produtos.nm_produto',
                                   'produtos.id_fornecedor',
                                   'produtos.nm_fornecedor',
                                   'produtos.vl_compra',
                                   'produtos.vl_venda',
                                   'produtos.cd_unidade',
                                   'produtos.qt_estoque',
                                   'produtos.qt_minestoque',
                                   'produtos.cd_barra',
                                   'produtos.st_convalescente',
                                   'produtos.nm_obs')                          
                          ->where('produtos.id_produto',$id)
                          ->first();

        $unidade = [
            0 => [
                'cd_unidade'=> 'UN',
                'nm_unidade'=> 'UNIDADE',
                ],
            1 => [
                'cd_unidade'=> 'KIT',
                'nm_unidade'=> 'KIT',
                ],        
            2 => [
                 'cd_unidade'=> 'KG',
                 'nm_unidade'=> 'KILO',
                ],            
        ];

        $action = action('ProdutoController@update', $produto->id_produto);            

        return view("produto.edit",[
            "produto" => $produto,
            "unidades" => $unidade,
            "action" => $action,
        ]);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        $produto->nm_produto = strtoupper($request->get('nm_produto'));
        $produto->id_fornecedor = $request->get('id_fornecedor');
        $produto->nm_fornecedor = strtoupper($request->get('nm_fornecedor'));
        $produto->vl_compra = $request->get('vl_compra');
        $produto->vl_venda = $request->get('vl_venda');    
        $produto->cd_unidade = strtoupper($request->get('cd_unidade'));    
        $produto->qt_estoque = $request->get('qt_estoque');    
        $produto->qt_minestoque = $request->get('qt_minestoque');    
        $produto->cd_barra = strtoupper($request->get('cd_barra'));    
        $produto->st_convalescente = $request->get('st_convalescente') !== null ? '1' : '0';
        $produto->nm_obs = strtoupper($request->get('nm_obs'));    
        $produto->id_user = Auth::id();
        $produto->created_at = date('Y-m-d H:i:s');
        $produto->save();

        $request->session()->flash('alert-success', 'Alterado com sucesso!');
        return Redirect::to('produto');
    }

    public function destroy(Request $request,$id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        $request->session()->flash('alert-success', 'Apagado com sucesso!');
        return redirect()->back();        
    }
}
