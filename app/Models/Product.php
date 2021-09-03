<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'product_name',
        'product_price',
        'product_image'
    ];
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
