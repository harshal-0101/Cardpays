<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxes extends Model
{
    protected $table = 'taxes';
    protected $fillable = [
        'Name',
        'rate',
        'Default',
        'Enabled',
    ];
}
