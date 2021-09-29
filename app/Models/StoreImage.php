<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'db_address',
    ];
    
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
