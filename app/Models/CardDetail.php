<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    protected $table = 'card_details';
    protected $fillable = [
        'lead_id',
        'bank_name',
        'bill_amount',
        'due_date',
        'card_type',
        'card_status'
    ];

    public function lead()
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }

}
