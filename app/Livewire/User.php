<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination; // ใช้ trait WithPagination เพื่อจัดการการแบ่งหน้าข้อมูล
    public $search = ''; // ตัวแปรเก็บคำที่ต้องการค้นหา
    public function updatingSearch()
    {
        // เมื่อมีการอัปเดตค่าใน $search ให้รีเซ็ตเพจกลับไปหน้าแรก
        $this->resetPage();
    }
    public function render()
    {
        // ค้นหาข้อมูลผู้ใช้ตามคำที่กรอกใน $search และแบ่งหน้าแสดงผล
        // โดยใช้ฟังก์ชัน search ที่สร้างขึ้นก่อนหน้านี้
        return view('livewire.user', [
            'users' => ModelsUser::search(['name', 'email'], $this->search, 'contains', 'or')->paginate(5),
        ]);

        // return view('livewire.user', [
        //     'users' => ModelsUser::paginate(5),
        // ]);
    }
}
