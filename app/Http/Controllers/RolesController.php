<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Roles::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolesRequest $request)
    {
        // ดึงข้อมูลที่ผ่านการตรวจสอบจาก request
        $validated = $request->validated();

        // สร้าง Role ใหม่ด้วยข้อมูลที่ผ่านการตรวจสอบ
        $role = Roles::create($validated);

        // แสดงข้อความแจ้งเตือน "สร้าง role ใหม่สำเร็จ" และ redirect ไปยังหน้า roles.index
        return redirect()->route('roles.index')
            ->with('success', 'สร้าง role ใหม่สำเร็จ');
    }


    /**
     * Display the specified resource.
     */
    public function show(Roles $role)
    {
        //  เรียกใช้ Policy (optional)
        //  $this->authorize('view', $role);
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $role)
    {
        //  เรียกใช้ Policy (optional)
        //  $this->authorize('view', $role);
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Roles $role, UpdateRolesRequest $request)
    {
        // ดึงข้อมูล "ข้อมูลเดิม"
        $oldData = $role->getOriginal();

        // ดึงข้อมูล "ข้อมูลที่แก้ไข"
        $newData = $request->validated();

        // เปรียบเทียบข้อมูล
        $diff = array_diff($newData, $oldData);
        $role->update($request->validated());

        // แสดงข้อความ
        return redirect()->route('roles.index')
            ->with('success', 'แก้ไขข้อมูล [' . implode(', ', array_keys($diff)) . '] เป็น [' . implode(', ', $newData) . '] สำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
