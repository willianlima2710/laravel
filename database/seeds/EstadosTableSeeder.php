<?php

use Illuminate\Database\Seeder;
use App\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::insert
        ([
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'PARANA',
                'nm_sigla'  =>  'PR'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'ALAGOAS',
                'nm_sigla'  =>  'AL'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'AMAZONAS',
                'nm_sigla'  =>  'AM'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'AMAPA',
                'nm_sigla'  =>  'AP'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'BAHIA',
                'nm_sigla'  =>  'BA'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'CEARA',
                'nm_sigla'  =>  'CE'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'DISTRITO FEDERAL',
                'nm_sigla'  =>  'DF'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'ESPIRITO SANTO',
                'nm_sigla'  =>  'ES'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'GOIAS',
                'nm_sigla'  =>  'GO'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'MARANHAO',
                'nm_sigla'  =>  'MA'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'MINAS GERAIS',
                'nm_sigla'  =>  'MG'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'MATO GROSSO DO SUL',
                'nm_sigla'  =>  'MS'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'MATO GROSSO',
                'nm_sigla'  =>  'MT'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'PARA',
                'nm_sigla'  =>  'PA'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'PARAIBA',
                'nm_sigla'  =>  'PB'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'PERNANBUCO',
                'nm_sigla'  =>  'PE'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'PIAUI',
                'nm_sigla'  =>  'PI'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'RIO DE JANEIRO',
                'nm_sigla'  =>  'RJ'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'RIO GRANDE DO NORTE',
                'nm_sigla'  =>  'RN'
            ],
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'RONDONIA',
                'nm_sigla'  =>  'RO'
            ],   
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'RORAIMA',
                'nm_sigla'  =>  'RR'
            ],   
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'RIO GRANDE DO SUL',
                'nm_sigla'  =>  'RS'
            ],   
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'SANTA CATARINA',
                'nm_sigla'  =>  'SC'
            ],   
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'SERGIPE',
                'nm_sigla'  =>  'SE'
            ],   
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'SAO PAULO',
                'nm_sigla'  =>  'SP'
            ],   
            [            
                'id_user'   =>  1,
                'nm_estado' =>  'TOCANTINS',
                'nm_sigla'  =>  'TO'
            ],   
        ]);   
    }
}
