<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Linkedinresume extends Model
{
    protected $table = 'linkedinresumes';
    protected $casts = [
        'resume' => 'array',
    ];
    protected $fillable = [
        'resume','provider_id'
    ];
}
