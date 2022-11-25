<?php

use Illuminate\Database\Seeder;
use App\Estcivil;

class EstcivilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estcivil::insert
        ([
            [            
                'id_user'     => 1,
                'nm_estcivil' => 'CASADO(A)',
            ],                        
            [            
                'id_user'     => 1,
                'nm_estcivil' => 'SOLTEIRO(A)',
            ],                        
            [            
                'id_user'     => 1,
                'nm_estcivil' => 'DIVORCIADO(A)',
            ],                        
            [            
                'id_user'     => 1,
                'nm_estcivil' => 'UNIAO ESTAVEL',
            ],                        
            [            
                'id_user'     => 1,
                'nm_estcivil' => 'SEPARACAO JUDICIAL',
            ],                        
            [            
                'id_user'     => 1,
                'nm_estcivil' => 'VIUVO(A)',
            ],                        
            [            
                'id_user'     => 1,
                'nm_estcivil' => 'SEPARADO(A)',
            ],                        
        ]);
    }
}
