<?php

Route::group(['middleware' => ['web','auth']], function() {
    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');
    Route::get('/completefornecedor', 'FornecedorController@autocomplete')->name('completefornecedor');
    Route::get('/completecliente', 'ClienteController@autocomplete')->name('completecliente');
    Route::get('/completepessoa', 'PessoaController@autocomplete')->name('pessoafornecedor');
    Route::get('/completecontrdep', 'ContratodepController@autocomplete')->name('completecontrdep');
    Route::get('/printpdf/{id}', 'ContratoController@imprimir')->name('printpdf');
    Route::post('/impctapagar','RelctapagarController@impctapagar')->name('impctapagar');
    Route::post('/impcaixa','RelcaixaController@impcaixa')->name('impcaixa');

    //-- Rotas de operações tais como CRUD
    Route::resources([                
        'agendamento' => 'AgendamentoController',
        'causamorte' => 'CausamorteController',
        'funcoes' => 'FuncoesController',
        'fxacidade' => 'FxacidadeController',
        'parentesco' => 'ParentescoController',
        'religiao' => 'ReligiaoController',
        'tppagamento' => 'TppagamentoController',
        'medico' => 'MedicoController',
        'regioes' => 'RegioesController',
        'cliente' => 'ClienteController',
        'estcivil' => 'EstcivilController',
        'fornecedor' => 'FornecedorController',
        'funcionario' => 'FuncionarioController',
        'produto' => 'ProdutoController',
        'plano' => 'PlanoController',
        'cemiterio' => 'CemiterioController',
        'empresa' => 'EmpresaController',
        'planoconta' => 'PlanocontaController',
        'veiculo' => 'VeiculoController',
        'banco' => 'BancoController',
        'custo' => 'CustoController',
        'jazigo' => 'JazigoController',
        'contrato' => 'ContratoController',
        'contratodep' => 'ContratodepController',
        'ctareceber' => 'CtareceberController',
        'ctapagar' => 'CtapagarController',
        'caixa' => 'CaixaController',
        'protocolo' => 'ProtocoloController',
        'obito' => 'ObitoController',
        'estado' => 'EstadoController',
        'pessoa' => 'PessoaController',
        'parametro' => 'ParametroController',
        'capela' => 'CapelaController',
        'relctapagar' => 'RelctapagarController',
        'relcaixa' => 'RelcaixaController',
    ]);
});

Auth::routes();