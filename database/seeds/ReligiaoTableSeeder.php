<?php

use Illuminate\Database\Seeder;
use App\Religiao;

class ReligiaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Religiao::insert
        ([
            [            
                'id_user'     => 1,
                'nm_religiao' => 'CATOLICO(A)',
            ],
            [            
                'id_user'     => 1,
                'nm_religiao' => 'EVANGELICA(O)',
            ],
            [            
                'id_user'     => 1,
                'nm_religiao' => 'JUDAICA',
            ],
            [            
                'id_user'     => 1,
                'nm_religiao' => 'ESPIRITA',
            ],
            [            
                'id_user'     => 1,
                'nm_religiao' => 'INDEFINIDA',
            ],
            [            
                'id_user'     => 1,
                'nm_religiao' => 'ADVENTISTA',
            ],
        ]);    
    }
}
