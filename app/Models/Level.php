<?php

namespace App\Models;
use App\Models\Level;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
      protected $guarded = array();
        
public function run()
{
    Level::factory()
            ->create();
}
}
