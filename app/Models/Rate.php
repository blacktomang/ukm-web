<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'value'
    ];

    public function product(){
        $this->belongsTo(Product::class);
    }
    public function user(){
        $this->hasOne(User::class);
    }
}
