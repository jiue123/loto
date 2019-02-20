<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'phone',
        'matrix',
        'refresh'
    ];
}
