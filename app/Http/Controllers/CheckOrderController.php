<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CheckOrderController extends Controller
{
    public function index()
    {
        return view('checkorders.index'); // View สำหรับแสดง DataTable
    }

    public function data(Request $request)
    {
        $query = Order::with('customer', 'orderItems.drink');

        return DataTables::of($query)
            ->addColumn('customer_name', fn($order) => $order->customer->name)
            ->addColumn('items', function ($order) {
                return $order->orderItems
                    ->map(fn($item) => $item->drink->name . ' x ' . $item->quantity)
                    ->implode('<br>');
            })
            ->rawColumns(['items']) // ถ้ามี <br> หรือ HTML
            ->make(true);
    }
}
