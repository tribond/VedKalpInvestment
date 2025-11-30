<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SymbolData extends Model
{
    //
    use HasFactory;

    protected $table = 'symbol_data'; // Ensure this matches your actual table name

    protected $fillable = [
        'token',
        'symbol',
        'name',
        'expiry',
        'strike',
        'lotsize',
        'instrumenttype',
        'exch_seg',
        'tick_size'
    ];

    protected $casts = [
        'strike' => 'decimal:6',
        'tick_size' => 'decimal:6',
        'lotsize' => 'integer',
    ];

    public $timestamps = false;
}
