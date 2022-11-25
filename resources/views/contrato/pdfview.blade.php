<table border="1" cellspacing="1" cellpadding="10" width ="100%">
            <thead>
            <tr>
                <th>Data Inc</th>
                <th>Nº Contrato</th>
                <th>Nome</th>
                <th>$ Valor</th>
            </tr>     
            </thead>       
            <tbody>                
            @foreach ($contratos as $contrato)            
            <tr>
                <td>{{ empty($contrato->dt_inccontrato) ? '' : $contrato->dt_inccontrato->format("d/m/Y") }}</td>
                <td>{{ $contrato->nr_contrato }}</td>
                <td>{{ $contrato->nm_pessoa }}</td>
                <td>{{ number_format($contrato->vl_total, 2, '.', '') }}</td>
            </tr>
            @endforeach
        </tbody>
        </table>