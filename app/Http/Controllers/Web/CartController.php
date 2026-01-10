<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $serviceId = $request->input('service_id');
        $service = Service::findOrFail($serviceId);

        $cart = Session::get('cart', []);

        if (!empty($cart)) {
            return response()->json(['success' => false, 'message' => 'You can only add one service to cart at a time. Please checkout or remove the existing item.']);
        }

        $cart[$serviceId] = [
            'id' => $service->id,
            'title' => $service->title,
            'subscription_type' => $service->subscription_type,
            'amount' => $service->subscription_amount,
            'duration' => $service->subscription_duration,
            'quantity' => 1,
        ];

        Session::put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Added to cart']);
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        $services = collect($cart)->map(function ($item) {
            return (object) $item;
        });

        return view('pages.cart', compact('services'));
    }

    public function removeFromCart(Request $request)
    {
        $serviceId = $request->input('service_id');
        $cart = Session::get('cart', []);

        unset($cart[$serviceId]);

        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('services');
        }

        $services = collect($cart)->map(function ($item) {
            return (object) $item;
        });

        $total = $services->sum(function ($service) {
            return $service->amount * $service->quantity;
        });

        return view('pages.checkout', compact('services', 'total'));
    }

    public function processPayment(Request $request)
    {
        // For now, simulate Paytm payment
        // In real, use Paytm SDK

        $cart = Session::get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['amount'] * $item['quantity'];
        });

        // Simulate success
        // Create PaymentHistory
        $user = auth()->user();
        foreach ($cart as $serviceId => $item) {
            PaymentHistory::create([
                'user_id' => $user->id,
                'transaction_id' => 'VKI' . time() . rand(1000, 9999),
                'amount' => $item['amount'],
                'payment_status' => 'success',
                'payment_method' => 'Paytm',
                'service_id' => $serviceId,
                'paid_at' => now(),
            ]);
        }

        Session::forget('cart');

        return redirect()->route('payment.history')->with('success', 'Payment successful');
    }
}