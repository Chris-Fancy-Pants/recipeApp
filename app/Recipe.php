<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['name', 'description', 'serves', 'prep_time', 'cook_time', 'created_by'];
}
