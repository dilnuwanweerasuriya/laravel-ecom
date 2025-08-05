<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'payment_method',
        'status',
        'transaction_id',
        'paid_at',
    ];

    protected $dates = ['paid_at'];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
