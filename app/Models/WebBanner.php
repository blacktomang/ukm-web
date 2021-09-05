<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebBanner extends Model
{
    use HasFactory;
    //  $table->string('title');
    //         $table->string('sub_title');
    //         $table->string('image');

    protected $fillable = [
        'title',
        'sub_title',
        'image'
    ];
}
