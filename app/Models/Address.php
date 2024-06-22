<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'address', 'subdistrict_id', 'district_id', 'province_id', 'postcode', 'address_type'
    ];

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
