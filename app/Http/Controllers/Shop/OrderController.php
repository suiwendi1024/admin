<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::latest('id')
            ->select([
                'id',
                'customer_name' => User::select('name')
                    ->whereColumn('users.id', 'user_id')
                    ->limit(1),
                'total',
                'created_at'
            ])
            ->when($request->search, function (Builder $query) use ($request) {
                return $query->whereHas('customer', function (Builder $q) use ($request) {
                    return $q->where('name', 'like', "%{$request->search}%");
                });
            })
            ->with('customer')
            ->paginate($request->perPage);
        $orders->makeHidden([
            'customer',
        ]);

        return inertia('Shop/Orders/Index', [
            'orders' => fn() => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
