<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dolar extends Model
{
    protected $fillable = ['fecha', 'valor'];
    public $timestamps = true;
}
