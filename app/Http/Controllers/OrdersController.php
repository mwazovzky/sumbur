<?php

namespace App\Http\Controllers;

use App\Order;
use App\Status;
use App\Process;
use App\Furniture;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class OrdersController extends Controller
{
    public function __construct()
    {
        // any signed in user can see and create orders
        $this->middleware('auth')->only(['index', 'store']);
        // only admin can update/delete orders
        $this->middleware('admin')->except(['index', 'store']);
    }

    /**
     * Fetch all orders.
     * List of existing processes and statuses is provided to construct select elements
     * without additional server requests
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('furniture')->latest()->get();
        $processes = Process::all();
        $statuses = Status::all();

        return response([
            'orders' => $orders,
            'processes' => $processes,
            'statuses' => $statuses,
        ], 200);
    }

    /**
     * Store a newly created order in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'status' => ['required', 'in:' . implode(',', Status::all())],
            'process' => ['required', 'in:' . implode(',', Process::all())],
            'furniture_id' => 'exists:furniture,id',
        ]);

        $order = Order::create($attributes);

        return $order->load('furniture');
    }

    /**
     * Update the specified order status in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $attributes = $request->validate([
            'status' => ['required', 'in:' . implode(',', Status::all())],
        ]);

        $order->update($attributes);

        return $order;
    }

    /**
     * Remove the specified order from database.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response(['deleted'], 204);
    }
}
