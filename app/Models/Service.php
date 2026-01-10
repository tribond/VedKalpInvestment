<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'services';

    protected $fillable = [
        'title',
        'subscription_type',
        'description',
        'subscription_amount',
        'subscription_duration',
        'is_active',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'subscription_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Constants for subscription duration
     */
    public const DURATION_MONTHLY = 'monthly';
    public const DURATION_YEARLY = 'yearly';
}
