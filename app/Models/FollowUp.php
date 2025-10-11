<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
     protected $fillable = [
        'lead_id',
        'stage',
        'Telecaller'
    ];

    public function lead()
    {
        return $this->belongsTo(Leads::class, 'lead_id');
    }
}
