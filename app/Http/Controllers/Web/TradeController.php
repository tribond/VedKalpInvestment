<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ApiService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Trade;
use Illuminate\Support\Facades\Auth;
use App\Models\Strategy;
use App\Models\Script;
use Illuminate\Support\Facades\Session;
use App\Models\TradingLog;
use App\Models\User;

class TradeController extends Controller
{
    public function tradeslist()
    {    
        $userId = Auth::id();
        if($userId){
            $trades = Trade::where(['user_id'=>$userId,'trade_executed'=>0])->get();
        }
        $product_list =Script::pluck('script_name','script_token')->toArray();
        
        $starategy_list = Strategy::pluck('name','id')->toArray();
        return view('trade.trade-list',compact('product_list','starategy_list','trades'));
    }

    public function add(Request $request)
    {
    
        // Loop through each trade data
        $requstData = $request->all();
        foreach ($requstData['data'] as $tradeData) {
                // If ID is blank, create a new trade
                Trade::create([
                    'user_id' => Auth::id(),
                    'product_id' => $tradeData['product'],
                    'stratagy_id' => $tradeData['strategy'], // Ensure correct spelling in your database
                    'quantity' => $tradeData['quantity'],
                    'is_live' => $tradeData['live'] ?? 0,
                    'created_at' => now()
                ]);
        }
    
        return redirect()->back()->with('success', 'Trades saved successfully!');
    }

    public function update(Request $request)
    {
        // Validate the incoming data
        $requstData = $request->all();
    
        // Loop through each trade data
        foreach ($requstData['data'] as $tradeData) {
            if (empty($tradeData['id'])) {
                // If ID is blank, create a new trade
                Trade::create([
                    'user_id' => Auth::id(),
                    'product_id' => $tradeData['product'],
                    'stratagy_id' => $tradeData['strategy'], // Ensure correct spelling in your database
                    'quantity' => $tradeData['quantity'],
                    'is_live' => $tradeData['live'] ?? 0,
                    'created_at' => now()
                ]);
            } else {
                // Find the trade record by ID
                $trade = Trade::find($tradeData['id']);
    
                if ($trade) {
                    // Update the existing trade with new data
                    $trade->update([
                        'user_id' => Auth::id(),
                        'product_id' => $tradeData['product'],
                        'stratagy_id' => $tradeData['strategy'],
                        'quantity' => $tradeData['quantity'],
                        'is_live' => $tradeData['live'] ?? 0,
                        'updated_at' => now(),
                    ]);
                } else {
                    // Optional: Log an error or handle the case where the trade is not found
                }
            }
        }
    
        // Redirect back with a success message
        return redirect()->route('trades.list')->with('success', 'Trades updated successfully!');
    }

    public function toggleLive(Request $request)
    {
        $request->validate([
            'live' => 'required|boolean',
            'index' => 'required|integer'
        ]);

        // Assuming $trades is the collection you're iterating over
        $id = $request->index;
        $status = $request->live;

        $trade = Trade::find($id);
    
        $trade->update(['is_live' => $status]);
                   

        return response()->json(['success' => true, 'message' => 'Live status updated successfully']);
    }

    public function destroy($id)
    {
        $trade = Trade::find($id);

        if ($trade) {
            $trade->delete();
            return redirect()->back()->with('success', 'Trade deleted successfully.');
        }

        return redirect()->back()->with('fail', 'Trade not found.');
    }

    public function tradeHistory(Request $request)
    {
        $userId = Auth::id();
        $query = Trade::where('user_id', $userId)->with(['user','tradelog']);

        if ($request->has('trade_type') && $request->trade_type != '') {
            $query->whereHas('tradelog', function ($q) use ($request) {
                $q->where('trade_type', $request->trade_type);
            });
        }

        $tradinghistory = $query->paginate(10);
        $script_list = Script::pluck('script_name','script_token')->toArray();
        $strategy_list = Strategy::pluck('name','id')->toArray();
        //echo '<pre>'; print_r($tradinghistory); exit;
        return view('trade.trade-history', compact('tradinghistory','script_list','strategy_list'));
    }

    
}
