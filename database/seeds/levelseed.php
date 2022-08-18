<?php

use Illuminate\Database\Seeder;

class levelseed extends Seeder
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
            'name_en' => 'Bronze',
             'name_ar' => 'البرونزى',
            'no_point' => 5,
            'no_trip' => 100,
        ],
        [
            'name_aen' => 'silver',
             'name_ar' => 'الفضى',
            'no_point' => 10,
            'no_trip' => 200,

        ],
        [
              'name_en' => 'golden',
             'name_ar' => 'الدهبى',
            'no_point' => 15,
            'no_trip' => 300,

        ],
        [
                   'name_en' => 'diamonds',
             'name_ar' => 'الألماسى',
            'no_point' => 20,
            'no_trip' => 400,
        ],
        
       
        ];

        DB::table('levels')->insert($Records);
    }
}
