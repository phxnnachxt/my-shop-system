<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Drink;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'orderItems.drink'])->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $drinks = Drink::all();
        return view('orders.create', compact('customers', 'drinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'drinks' => 'required|array',
            'drinks.*' => 'exists:drinks,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        $order = Order::create([
            'customer_id' => $request->customer_id,
        ]);

        foreach ($request->drinks as $index => $drinkId) {
            $quantity = $request->quantities[$index] ?? 1;

            $order->orderItems()->create([
                'drink_id' => $drinkId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        $drinks = Drink::all();

        $order->load('orderItems.drink');

        return view('orders.edit', compact('order', 'customers', 'drinks'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'drinks' => 'required|array',
            'drinks.*' => 'exists:drinks,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ]);

        $order->update([
            'customer_id' => $request->customer_id,
        ]);

        // ลบ order items เดิมก่อน
        $order->orderItems()->delete();

        // สร้าง order items ใหม่
        foreach ($request->drinks as $index => $drinkId) {
            $quantity = $request->quantities[$index] ?? 1;

            $order->orderItems()->create([
                'drink_id' => $drinkId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->orderItems()->delete();
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    // เพิ่มฟังก์ชัน show สำหรับแสดงรายละเอียด order
    public function show(Order $order)
    {
        $order->load(['customer', 'orderItems.drink']);
        return view('orders.show', compact('order'));
    }
}
