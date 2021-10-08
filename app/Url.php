<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'url';
    
    protected $fillable = [
        'original_url', 'shorted_url'
    ];
}
