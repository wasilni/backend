<?php

use Illuminate\Database\Seeder;

class pointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
          $Records = [
              
         [
            'no_point' => 100,
            'price' => 10,
            'typeuses' => 'driver',
        ],
        [
            'no_point' => 250,
            'price' => 25,
             'typeuses' => 'driver',

        ],
        [
            'no_point' => 500,
            'price' => 50,
            'typeuses' => 'driver',

        ],
        [
            'no_point' => 1000,
            'price' => 100,
             'typeuses' => 'driver',

        ],
        
         [
            'no_point' => 100,
            'price' => 10,
            'typeuses' => 'user',
        ],
        [
            'no_point' => 250,
            'price' => 25,
             'typeuses' => 'user',

        ],
        [
            'no_point' => 500,
            'price' => 50,
            'typeuses' => 'user',

        ],
        [
            'no_point' => 1000,
            'price' => 100,
             'typeuses' => 'user',

        ]
        
        ];

        DB::table('points')->insert($Records);
    }
}
