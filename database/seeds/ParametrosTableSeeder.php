<?php

use Illuminate\Database\Seeder;
use App\Parametros;

class ParametrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parametros::insert
        ([
            [            
                'nr_docctapagar' =>  '1',
                'nr_contrato'    =>  '1',
            ],
        ]);           
    }
}
