<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::paginate(10);
        return view('drinks.index', compact('drinks'));
    }

    public function create()
    {
        return view('drinks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        Drink::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('drinks.index')->with('success', 'เพิ่มเครื่องดื่มเรียบร้อย');
    }

    public function edit(Drink $drink)
    {
        return view('drinks.edit', compact('drink'));
    }

    public function update(Request $request, Drink $drink)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $drink->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('drinks.index')->with('success', 'อัปเดตเครื่องดื่มเรียบร้อย');
    }

    public function destroy(Drink $drink)
    {
        $drink->delete();
        return redirect()->route('drinks.index')->with('success', 'ลบเครื่องดื่มเรียบร้อย');
    }
    
}
