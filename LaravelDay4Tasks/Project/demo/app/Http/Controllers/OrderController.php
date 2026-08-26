<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Http\Requests\OrderRequest;

use Error;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::all();
        return view('orders.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        //
        $requestedData = $request->validated();
        Order::create($requestedData);
        return to_route('orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $order = Order::findorfail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findorfail($id);
        $users = User::all();
        //
        return view('orders.update', compact('order', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        try {
            $validatedRequst = $request->validated();  // array
            $order = Order::findorfail($id);
            $order->update($validatedRequst);
            return view("orders.show", compact('order'));
            //code...
        } catch (Error $e) {
            //throw $th;
            $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $order = Order::findorfail($id);
        $order->delete();
        return to_route('orders.index');
    }
}
