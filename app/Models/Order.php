<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        // 'drink_id',  // ลบ drink_id ออก เพราะไม่ใช้ตรงนี้แล้ว
        // 'quantity',  // ลบ quantity ออก เพราะย้ายไปเก็บที่ order_items
    ];

    // ความสัมพันธ์กับ Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // ความสัมพันธ์กับ OrderItem (รายการเครื่องดื่มแต่ละรายการใน order)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // (Optional) ความสัมพันธ์แบบสะดวกกับ Drink ผ่าน OrderItem
    public function drinks()
    {
        return $this->belongsToMany(Drink::class, 'order_items')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
