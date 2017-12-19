<?php

namespace App\Http\Controllers;

use App\Order;
use App\Status;
use App\Process;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;

class OrdersController extends Controller
{
    public function __construct()
    {
        // any signed in user can see and create orders
        $this->middleware('auth')->only(['index', 'store']);
        // only admin can update/delete
        $this->middleware('admin')->except(['index', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index', ['orders' => Order::all()]);
    }

    /**
     * Store a newly created resource in storage.
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

        return $order;
    }

    /**
     * Update the specified resource in storage.
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
}
