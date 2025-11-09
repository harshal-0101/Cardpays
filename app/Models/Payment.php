<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'leads_id',
        'client',
        'amount',
        'date',
        'number',
        'year',
        'payment_mode',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class, 'leads_id');
    }
}
