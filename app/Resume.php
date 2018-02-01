<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resume';
    protected $casts = [
        'name' => 'array',
    ];
    protected $fillable = [
        'name', 'user_id','provider','id'
    ];
}
