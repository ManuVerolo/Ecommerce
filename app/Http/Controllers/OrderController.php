<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function payment(Order $order){
        $items = json_decode($order->content);
        return view('orders.payment', compact('order', 'items'));
    }

    public function show(Order $order){
        return view('orders.show', compact('order'));
    }

    public function pay(Order $order, Request $request){
        $payment_id =  $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-4263188580029300-020923-06595fd8658ed7f11c4402608d6aabd9-1071794860");
        
        $response = json_decode($response);

        $status = $response->status;

        if($status == 'approved'){
            $order->status = 2; 
            $order->save();
        }
        return redirect()->route('orders.show', $order);
    }
}
