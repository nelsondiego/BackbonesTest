<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlements extends Model
{
    protected $fillable = [
        'zipcode_id',
        'key',
        'name',
        'zone_type',
        'settlement_type_name',
    ];

    public function Zipcode()
    {
        return $this->belongsTo(Zipcode::class);
    }
}
