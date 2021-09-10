<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class smm_product_request extends Model
{
    use HasFactory;
    protected $fillable = ['nik', 'date_request', 'list_product', 'date'];
}
