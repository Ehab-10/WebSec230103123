<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'code',
    'name',
    'model',
    'price',
    'photo',
    'description',
];

}
