<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class smm_users extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'nik', 'departemen', 'phone', 'email', 'gender', 'province', 'city', 'subdistrict', 'address', 'date'];
}
