<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
{
    $orders = Order::where(
        'user_id',
        Auth::id()
    )->latest()->get();

    return view(
        'orders.index',
        compact('orders')
    );
}
    public function store(Request $request, Food $food)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        $total = $food->harga * $request->qty;

        Order::create([
            'user_id' => Auth::id(),
            'food_id' => $food->id,
            'qty' => $request->qty,
            'total' => $total,
            'pickup_code' => strtoupper(substr(md5(time()), 0, 6)),
            'status' => 'pending'
        ]);

        $food->decrement('stok', $request->qty);

        return redirect('/menu')
            ->with('success', 'Pesanan berhasil dibuat');
    }
}