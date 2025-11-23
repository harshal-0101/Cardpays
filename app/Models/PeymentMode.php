<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeymentMode extends Model
{
    protected $table = 'peyment_modes';
    protected $fillable = [
        'Payment_Mode',
        'description',
        'Default',
        'Enabled'
    ];
}
