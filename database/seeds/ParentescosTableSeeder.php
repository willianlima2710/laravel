<?php

use Illuminate\Database\Seeder;
use App\Parentesco;

class ParentescosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parentesco::insert
        ([
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'TITULAR',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'PAI',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'MÃE',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'SOGRO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'CONJUGUE',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'FILHO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'DEPENDENTE',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'IRMAO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'AFILHADO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'AMIGO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'AGREGADO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'AVO(Ô)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'BISNETO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'COMPANHEIRO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'CUNHADA(O)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'ENTEADO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'GENRO',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'NAMORADA(O)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'NETO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'NORA',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'PRIMO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'SOBRINHO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'TIO(A)',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'PADRASTO',
            ],
            [            
                'id_user'       => 1,
                'nm_parentesco' => 'MADASTRA',
            ],
        ]);
    }
}
