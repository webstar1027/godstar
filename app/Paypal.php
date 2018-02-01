<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paypal extends Model
{
    protected $table = 'paypal';
    protected $fillable = [
        'user_id', 'email', 'subscriptions_type_id','state','cart','payer_id','recipient_name','total'
    ];
}
