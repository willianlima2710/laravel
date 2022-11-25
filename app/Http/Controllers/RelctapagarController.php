<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Ctapagar;
use Functions;
use Exception;
use PDF;

class RelctapagarController extends Controller
{
    public function index()
    {               
        return view("relctapagar.index",[
            'dt_inicial' => '',
            'dt_final' => '',        
            'nm_fornecedor' => '',
            'id_fornecedor' => '',    
        ]);
    }

    public function impctapagar(Request $request)
    {
        switch ($request->get('st_ctapagar')) {
            case '9' : 
                $st_status = array('0','1');
                $ds_status = 'Todos';
                break;
            case '0' :                 
                $st_status = array($request->get('st_ctapagar'));
                $ds_status = 'Abertos';
                break;
            case '1' :                 
                $st_status = array($request->get('st_ctapagar'));
                $ds_status = 'Pagos';
                break;
            case '2' :                 
                $st_status = array($request->get('st_ctapagar'));
                $ds_status = 'Inativos';
                break;    
        };

        $termo = (!empty($request->get('nm_fornecedor'))) ? $request->get('id_fornecedor') : '';
        $ctapagars = Ctapagar::whereBetween('dt_vencimento',[
                                            Functions::DateToEua($request->get('dt_inicial')),
                                            Functions::DateToEua($request->get('dt_final'))])
                             ->whereIn('st_status',$st_status)
                             ->where(function ($sql) use ($termo) {
                                 if (!empty($termo)) {
                                    $sql->where('id_fornecedor',$termo);
                                 }                                
                              })                              
                             ->orderByRaw('dt_vencimento asc','nm_pessoa asc')
                             ->get();
        $pdf = PDF::loadView('relctapagar.pdfview',[
            'ctapagars' => $ctapagars,
            'dt_inicial' => $request->get('dt_inicial'),
            'dt_final' => $request->get('dt_final'),
            'ds_status' => $ds_status,
        ]); 
        return $pdf->setPaper('A4','portrait')->stream();                    
    }
}
