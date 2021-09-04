<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_name',
        'address',
        'description',
        'contact'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function storeImages()
    {
        return $this->hasMany(StoreImage::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
