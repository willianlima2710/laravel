<?php

use Illuminate\Database\Seeder;
use App\TPpagamento;

class TPpagamentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TPpagamento::insert
        ([
            [            
                'id_user'        => 1,
                'nm_tppagamento' => 'DINHEIRO',
                'st_avista'      => 1
            ],
            [            
                'id_user'        => 1,
                'nm_tppagamento' => 'BOLETO',
                'st_avista'      => 0
            ],
            [            
                'id_user'        => 1,
                'nm_tppagamento' => 'CARTAO DE DEBITO',
                'st_avista'      => 1
            ],
            [            
                'id_user'        => 1,
                'nm_tppagamento' => 'CARTAO DE CREDITO',
                'st_avista'      => 1
            ],
            [            
                'id_user'        => 1,
                'nm_tppagamento' => 'CHEQUE',
                'st_avista'      => 0
            ],
            [            
                'id_user'        => 1,
                'nm_tppagamento' => 'TRANSFERENCIA',
                'st_avista'      => 1
            ],
            [            
                'id_user'        => 1,
                'nm_tppagamento' => 'DEPOSITO',
                'st_avista'      => 1
            ],
            [            
                'id_user'        => 1,
                'nm_tppagamento' => 'OUTROS',
                'st_avista'      => 0
            ],
        ]);
    }
}
