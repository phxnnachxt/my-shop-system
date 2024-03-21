<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    private $user;
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->user = $userRepositoryInterface;
    }

    public function userById(Request $request)
    {
        // รับค่า id ที่ส่งมาจาก request
        $id = $request->id;

        // ค้นหาผู้ใช้โดยใช้ id ที่รับมาจากฐานข้อมูล
        $user = $this->user->find($id, ['role']);

        // โดยใช้ Eloquent eager loading ดึงข้อมูล role มาด้วย
        // $user = User::with('role')->find($id);

        // ส่งข้อมูลผู้ใช้กลับเป็น JSON response
        return response()->json($user);
    }
}
