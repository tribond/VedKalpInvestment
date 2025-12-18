<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentHistory extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'payment_status',
        'payment_method',
        'service_id',
        'receipt_number',
        'paid_at'
    ];

     protected $casts = [
        'gateway_response' => 'array',
        'paid_at' => 'datetime',
    ];

}
