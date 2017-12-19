<?php

namespace App\Http\Controllers;

use App\Furniture;
use Illuminate\Http\Request;

class FurnitureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
        $this->middleware('admin')->except('index');
    }

    /**
     * Fetch all orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $furniture = Furniture::all();

        return response($furniture, 200);
    }

    /**
     * Store a newly created furniture item into database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $item = Furniture::create($attributes);

        return response($item, 200);
    }

    /**
     * Update the specified furniture item in database.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Furniture $furniture)
    {
        $attributes = $request->validate([
            'name' => 'sometimes|required',
            'description' => 'sometimes|required',
        ]);

        $furniture->update($attributes);

        return response($furniture, 200);
    }

    /**
     * Remove the specified furniture item from database.
     *
     * @param  \App\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Furniture $furniture)
    {
        $furniture->delete();

        return response(['deleted'], 204);
    }
}
