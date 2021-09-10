<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class smm_product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category', 'description', 'sku', 'harga_pokok', 'harga_jual', 'satuan', 'stok', 'berat', 'lokasi', 'date'];
}
