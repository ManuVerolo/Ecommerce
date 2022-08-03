<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function __invoke()
    {
        $orders = Order::all();
        $users = User::all();

        $orders_count = $orders->count();
        $users_count = $users->count();

        $orders_total = $orders->sum('total');
        $orders_count_month = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $orders_total_month = Order::whereMonth('created_at', Carbon::now()->month)->sum('total');
        $orders_with_shipping = Order::where('envio_type', 2)->count();
        $orders_without_shipping = Order::where('envio_type', 1)->count();

        $users_count_month = User::whereMonth('created_at', Carbon::now()->month)->count();
        

        return view('admin.statistics.index', compact('orders_count', 
                                                      'users_count', 
                                                      'orders_total', 
                                                      'orders_count_month', 
                                                      'orders_total_month',
                                                      'users_count_month',
                                                      'orders_with_shipping',
                                                      'orders_without_shipping'));
    }
}
