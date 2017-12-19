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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('furniture.index', ['furniture' => Furniture::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // authorization

        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $item = Furniture::create($attributes);

        return response([$item], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Furniture  $furniture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Furniture $furniture)
    {
        // authorize

        $attributes = $request->validate([
            'name' => 'sometimes|required',
            'description' => 'sometimes|required',
        ]);

        $furniture->update($attributes);

        return response([$furniture], 200);
    }

    /**
     * Remove the specified resource from storage.
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
