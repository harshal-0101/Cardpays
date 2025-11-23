<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [
        'Comp_Name',
        'Comp_Address',
        'Comp_State',
        'Comp_Country',
        'Comp_Email',
        'Comp_Phone',
        'Comp_Website',
        'Comp_Tax_Number',
        'Comp_Vat_Number',
        'Compa_Reg_Number'
    ];
}
