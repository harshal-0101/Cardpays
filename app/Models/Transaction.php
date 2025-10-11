<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
      'lead_id',
      'Service',
      'Bank',
      'Card_Type',
      'Charge',
      'Swipe_Amt',
      'Swipe_Mode',
      'Payment',
      'Pay_Mode',
      'Charge_Amt',
      'Short',
      'receivable'
    ];

    public function lead()
    {
        return $this->belongsTo(Leads::class , 'lead_id');
    }
}
