<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingLog extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id','trade_id', 'trade_type','trading_symbol','symbol_token','request_trade', 'response_trade', 'created_at', 'updated_at'];
    
}
