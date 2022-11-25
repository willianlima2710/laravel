<?php

use Illuminate\Database\Seeder;
use App\Funcoes;

class FuncoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Funcoes::insert
        ([
            [            
                'id_user'   => 1,
                'nm_funcao' => 'MOTORISTA',
            ],
            [            
                'id_user'   => 1,
                'nm_funcao' => 'COBRADOR',
            ],
            [            
                'id_user'   => 1,
                'nm_funcao' => 'VENDEDOR',
            ],
            [            
                'id_user'   => 1,
                'nm_funcao' => 'SECRETÁRIA',
            ],
            [            
                'id_user'   => 1,
                'nm_funcao' => 'GER. FINANCEIRA(O)',
            ],
            [            
                'id_user'   => 1,
                'nm_funcao' => 'CAMINHONEIRO',
            ],
        ]);        
    }
}
