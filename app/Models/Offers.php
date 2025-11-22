<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table = 'offers';
    protected $fillable = [
        'title',
        'description',
        'lead_id',
        'date',
        'expiry_date',
        'status',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
