<?php

namespace App\Models;

use App\Models\Pont;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
        protected $guarded = array();
        
public function run()
{
    Point::factory()
            ->create();
}
}
