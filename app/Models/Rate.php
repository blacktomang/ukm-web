<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'value'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user(){
       return  $this->hasOne(User::class);
    }
}
