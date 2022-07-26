<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    protected $fillable = [
        'zip_code',
        'locality',
        'federal_entity_key',
        'federal_entity_name',
        'federal_entity_code',
        'municipality_key',
        'municipality_name'
    ];

    public function settlements()
    {
        return $this->hasMany(Settlements::class);
    }
}
