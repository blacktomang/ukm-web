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
        'stocks',
        'rate',
        'description',
        'product_image'
    ];
    public function stores()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function rates(){
        return $this->hasMany(Rate::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public static function rupiah($angka){
         $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
         return $hasil_rupiah;
     }
}
