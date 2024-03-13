<?php

// namespace ระบุชื่อพื้นที่ของอินเทอร์เฟซ
namespace App\Repositories;

// use Model จาก Eloquent ORM มาใช้งาน
use Illuminate\Database\Eloquent\Model;

/**
 * อินเทอร์เฟซ BaseRepositoryInterface
 *
 * กำหนดเมธอดพื้นฐานสำหรับการจัดการข้อมูลกับ Eloquent ORM 5555
 */
interface BaseRepositoryInterface
{
    public function all();

    /**
     * ฟังก์ชันสำหรับค้นหาข้อมูลโมเดล by ID
     * @return Model|null โมเดล หรือ null
     */
    public function find($id):?Model;

    /**
     * ฟังก์ชันสำหรับสร้างโมเดลใหม่
     * @param array $data ข้อมูลสำหรับสร้างโมเดล
     * @return Model โมเดลที่สร้างใหม่
     */
    public function create(array $data): Model;

    /**
     * ฟังก์ชันสำหรับอัปเดตข้อมูลโมเดล
     * @param array $data ข้อมูลสำหรับอัปเดตโมเดล
     * @return Model โมเดลที่อัปเดตแล้ว
     */
    public function update($id, array $data): Model;

    /**
     * ฟังก์ชันสำหรับลบโมเดล
     *
     * @param int $id รหัสของโมเดล
     * @return void
     */
    public function delete($id);
}
