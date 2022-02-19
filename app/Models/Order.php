<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'f_name',
        'l_name',
        'email',
        'phone_num',
        'address_1',
        'address_2',
        'city',
        'state',
        'country',
        'pin_code',
        'status',
        'message',
    ];
}
