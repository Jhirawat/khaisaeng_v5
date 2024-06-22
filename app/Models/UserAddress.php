<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'phone', 'address', 'province_id', 'district_id', 'subdistrict_id', 'postcode', 'address_type'
    ];
}
