<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CtapagarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
        return [
            'id_fornecedor' => 'required',
            'nr_documento' => 'required',
            'nr_parcela' => 'required',
            'dt_vencimento' => 'required',                        
            'vl_pago' => 'nullable|numeric',
            'dt_pagamento' => 'required_if:vl_pago,>,0',
            'vl_juros' => 'nullable|numeric',
            'vl_multa' => 'nullable|numeric',
            'vl_desconto' => 'nullable|numeric',
            'id_tppagamento' => 'required',
            'id_banco' => 'required',
            'id_planoconta' => 'required',
            'ds_historico' => 'required',
        ];        
    }
}
