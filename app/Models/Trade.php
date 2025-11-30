<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trade extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id', 'product_id', 'stratagy_id', 'quantity', 'is_live','trade_executed', 'created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function tradelog()
    {
        return $this->belongsTo(TradingLog::class, 'id', 'trade_id');
    }
    
}
