<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eexpense extends Model
{

    protected $table = 'eexpenses';
    protected $fillable = [
        'name',
        'expense_category',
        'currency', 
        'total',
        'description',
        'reference',
    ];


}
