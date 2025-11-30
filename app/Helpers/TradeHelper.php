<?php
namespace App\Helpers;

use App\Models\Trade;
use App\Models\TradingLog;
use App\Models\SymbolData;
use App\Models\Script;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TradeHelper
{
    public static function tradeExecution($socket_messaage)
    {
        Log::info('TradeHelper : START');
        /* Trade For Nify50 Script */
        $socke_signal = json_decode($socket_messaage, true);

        $script_token = $socke_signal['token'];
        $socket_price = $socke_signal['ltp'];

        $live_trades_list = Trade::select(
            'trades.id as trade_id',
            'trades.user_id',
            'trades.product_id',
            'trades.stratagy_id',
            'trades.quantity',
            'trades.investment',
            'smart_api_users.auth_token',
            'smart_api_users.feed_token',
            'smart_api_users.refresh_token'
        )
            ->join('smart_api_users', 'trades.user_id', '=', 'smart_api_users.user_id')
            ->where('is_live', 1)
            ->where('product_id', $script_token) // NIFTY
            ->get()
            ->toArray();

        //Log::info('TradeHelper : $live_trades_list', [$live_trades_list]);
        $scriptName = Script::where('script_token', $script_token)->pluck('script_name')->first();

        foreach ($live_trades_list as $value) {
            $stratagy_id = $value['stratagy_id'];
            
            switch ($stratagy_id) {
                case 1:
                    break;
                case 2:
                    break;
                case 3:
                    break;
                case 4:
                    break;
                case 5: // 15 to 35
                    //Log::info('TradeHelper : CASE : 5 : START');
                    $parts = explode('.', $socket_price);
                    $stratagy_1535 = substr($parts[0], -2);
                    $ce_or_pe = 'CE';
                    //Log::info('TradeHelper : CASE : 5 : $stratagy_1535', [$stratagy_1535]);
                    
                    $buy_trade = TradingLog::where([ 'user_id' => $value['user_id'], 'trade_id' => $value['trade_id'], 'trade_type' => 1 ])->first();
                    Log::info('TradeHelper : CASE : 5 : $buy_trade', [$buy_trade]);

                    if ($stratagy_1535 == 15 && empty($buy_trade)) {
                        Log::info('TradeHelper : CASE : 5 : if($stratagy_1535 == 15 && empty($buy_trade))');
                        $options = SymbolData::where('symbol', 'LIKE', '%' . $ce_or_pe)->where('name', $scriptName)->pluck('symbol')->toArray();
                        $trading_symbol = self::getNearestOption($socket_price, $options, $scriptName);
                        $symboldata = SymbolData::where('symbol', $trading_symbol)->first();
                        $value['edit_id'] = 0;
                        $value['trading_symbol'] = $trading_symbol;
                        $value['symbol_token'] = $symboldata->token;
                        $value['transaction_type'] = "BUY";
                        Log::info('TradeHelper : CASE : 5 : if($stratagy_1535 == 15 && empty($buy_trade)) : $value',[$value]);
                        self::PlaceOrder($value);
                    }
                    if (($stratagy_1535 == 35 || $stratagy_1535 == 05) && !empty($buy_trade) && $buy_trade->trade_type == 1) {
                        Log::info('TradeHelper : CASE : 5 : if(($stratagy_1535 == 35 || $stratagy_1535 == 05) && !empty($buy_trade) && $buy_trade->trade_type == 1)');
                        $value['edit_id'] = $buy_trade->id;
                        $value['trading_symbol'] = $buy_trade->trading_symbol;
                        $value['symbol_token'] = $buy_trade->symbol_token;
                        $value['transaction_type'] = "SELL";
                        Log::info('TradeHelper : CASE : 5 : if(($stratagy_1535 == 35 || $stratagy_1535 == 05) && !empty($buy_trade) && $buy_trade->trade_type == 1) : $value', [$value]);
                        self::PlaceOrder($value);
                    }
                    Log::info('TradeHelper : CASE : 5 : END');
                    break;
                case 6: // 85 to 65
                    Log::info('TradeHelper : CASE : 6 : START');
                    $parts = explode('.', $socket_price);
                    $stratagy_8565 = substr($parts[0], -2);
                    $ce_or_pe = 'PE';
                    Log::info('TradeHelper : CASE : 6 : $stratagy_8565', [$stratagy_8565]);

                    $buy_trade = TradingLog::where(['user_id' => $value['user_id'],'trade_id' => $value['trade_id'],'trade_type' => 1])->first();
                    Log::info('TradeHelper : CASE : 6 : $buy_trade', [$buy_trade]);

                    if ($stratagy_8565 == 85 && empty($buy_trade)) {
                        Log::info('TradeHelper : CASE : 6 : if($stratagy_8565 == 85 && empty($buy_trade))');
                        $options = SymbolData::where('symbol', 'LIKE', '%' . $ce_or_pe)->where('name', $scriptName)->pluck('symbol')->toArray();
                        $trading_symbol = self::getNearestOption($socket_price, $options, $scriptName);
                        $symboldata = SymbolData::where('symbol', $trading_symbol)->first();
                        $value['edit_id'] = 0;
                        $value['trading_symbol'] = $trading_symbol;
                        $value['symbol_token'] = $symboldata->token;
                        $value['transaction_type'] = "BUY";
                        Log::info('TradeHelper : CASE : 6 : if($stratagy_8565 == 85 && empty($buy_trade)) : $value', [$value]);
                        self::PlaceOrder($value);
                    }
                    if (($stratagy_8565 == 65 || $stratagy_8565 == 95) && !empty($buy_trade) && $buy_trade->trade_type == 1) {
                        Log::info('TradeHelper : CASE : 6 : if($stratagy_8565 == 65 && !empty($buy_trade) && $buy_trade->trade_type == 1)');
                        $value['edit_id'] = $buy_trade->id;
                        $value['trading_symbol'] = $buy_trade->trading_symbol;
                        $value['symbol_token'] = $buy_trade->symbol_token;
                        $value['transaction_type'] = "SELL";
                        Log::info('TradeHelper : CASE : 6 : if($stratagy_8565 == 65 && !empty($buy_trade) && $buy_trade->trade_type == 1) : $value', [$value]);
                        self::PlaceOrder($value);
                    }
                    Log::info('TradeHelper : CASE : 6 : END');
                    break;
                default:
                    break;
            }
        }
        Log::info('TradeHelper : END');
    }

    public static function PlaceOrder($orderdata)
    {   
        Log::info('PlaceOrder : START');
        
        $data = [
            "variety" => "NORMAL",
            "tradingsymbol" => $orderdata['trading_symbol'],
            "symboltoken" => $orderdata['symbol_token'],
            "transactiontype" => $orderdata['transaction_type'],
            "exchange" => "NFO",
            "ordertype" => "MARKET",
            "producttype" => "CARRYFORWARD",
            "duration" => "DAY",
            "quantity" => $orderdata['quantity']
        ];

        Log::info('PlaceOrder : $data', [$data]);
        
        $headers = [
            'Authorization' => 'Bearer ' . $orderdata['auth_token'],
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'X-UserType' => 'USER',
            'X-SourceID' => 'WEB',
            'X-ClientLocalIP' => getHostByName(getHostName()),
            'X-ClientPublicIP' => file_get_contents('http://ipecho.net/plain'),
            'X-MACAddress' => '',
            'X-PrivateKey' => env('ANGELONE_API_KEY')
        ];


        $place_order_url = 'https://apiconnect.angelone.in/rest/secure/angelbroking/order/v1/placeOrder';
        $response = Http::withHeaders($headers)->post($place_order_url, $data);

        Log::info('PlaceOrder : $response', [$response]);
        // Handle the response
        if ($response->successful()) {
            Log::info('PlaceOrder : if($response->successful())');
            if($orderdata['edit_id'] == 0){
                Log::info('PlaceOrder : if($orderdata["edit_id"] == 0)');
                TradingLog::create([
                    'user_id' => $orderdata['user_id'],
                    'trade_id' => $orderdata['trade_id'],
                    'trade_type' => 1,
                    'trading_symbol' => $orderdata['trading_symbol'],
                    'symbol_token' => $orderdata['symbol_token'],
                    'request_trade' => json_encode($data),
                    'response_trade' => $response,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }else{
                Log::info('PlaceOrder : if($orderdata["edit_id"] == 0) else');
                $updateData = [
                    'trade_type' => 2,
                    'request_trade' => json_encode($data),
                    'response_trade' => $response,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                TradingLog::where('id',$orderdata['edit_id'])->update($updateData);
                Trade::where('id', $orderdata['trade_id'])->update(['is_live' => 0, 'trade_executed' => 1]);
            }
            // Log::debug('Place Order Response (Success):', ['response' => $response->json()]);
            
            Log::info('PlaceOrder : END');
            return response()->json(['success' => true, 'data' => $response->json()]);
        } else {
            Log::info('PlaceOrder : if($response->successful()) else');
            // Log::debug('Place Order Response (Fail):', ['response' => $response->json()]);
            Log::info('PlaceOrder : END');
            return response()->json(['success' => false, 'error' => $response->json()], $response->status());
        }
        
    }

    public static function getNearestOption($socket_stock_price, $options, $scriptName)
    {
        $nearestOption = null;
        $minDiff = PHP_INT_MAX;

        foreach ($options as $option) {
            // Extract last 5 or 6 digits before 'CE' or 'PE' as strike price
            $option = strtoupper($option); // Ensure case consistency BANKNIFTY27MAR2551200

            if (strpos($option, 'CE') !== false) {
                $strikePrice = str_replace([$scriptName, 'CE'], '', $option); // 27MAR2551200
            } elseif (strpos($option, 'PE') !== false) {
                $strikePrice = str_replace([$scriptName, 'PE'], '', $option); // 27MAR2551200
            } else {
                continue; // Skip if not a valid option
            }

            // Convert to integer
            $strikePrice = intval(substr($strikePrice, -5)); // Extract last 5 digits // 51200

            // Calculate absolute difference
            $diff = abs($socket_stock_price - $strikePrice);

            if ($diff < $minDiff) {
                $minDiff = $diff;
                $nearestOption = $option;
            }
        }
        return $nearestOption;
    }
}
