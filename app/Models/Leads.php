<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    protected $table = 'leads';
    protected $fillable = [
       'Name',
       'Mobile',    
       'City',
       'Cards',
       'Total_Bill',
       'Stage',
       'Source',
       'Due_Days',
       'Owner',
       'Created_By'
    ];
        
     public function cards()
    {
        return $this->hasMany(CardDetail::class, 'lead_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'lead_id');
    }

    public function followUps()
    {
        return $this->hasMany(FollowUp::class, 'lead_id');
    }
}
