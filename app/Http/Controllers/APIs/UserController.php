<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    private $user;
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->user = $userRepositoryInterface;
    }



    public function deleteApi(Request $request)
    {
        $data = $request->all();
        $userId = $data['userId'];

        // ตรวจสอบค่า null
        if (!$userId) {
            return response()->json([
                'message' => 'ไม่พบผู้ใช้',
                'code' => 404,
            ], 404);
        }

        try {
            // อัปเดตข้อมูล
            $user = $this->user->find($userId);
            $user->delete();

            // ลบข้อมูลสำเร็จ
            return response()->json([
                'message' => 'ลบข้อมูลสำเร็จ',
                'code' => 200,
            ], 200);
        } catch (ModelNotFoundException $e) {
            // ผู้ใช้ไม่ถูกพบ
            return response()->json([
                'message' => 'ไม่พบผู้ใช้',
                'code' => 404,
            ], 404);
        } catch (\Exception $e) {
            // อัพเดทไม่สำเร็จ
            return response()->json([
                'message' => 'ลบข้อมูลไม่สำเร็จ',
                'code' => 500,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function updateApi(Request $request)
    {
        $data = $request->all();
        $updat = [
            'email' => $data['email'],
            'name' => $data['name'],
            'roles_id' => $data['roles_id'],
        ];

        try {
            // อัปเดตข้อมูล
            $this->user->update($data['userId'], $updat);

            // อัพเดทสำเร็จ
            return response()->json([
                'message' => 'อัปเดตข้อมูลสำเร็จ',
                'code' => 200,
            ]);
        } catch (\Exception $e) {
            // อัพเดทไม่สำเร็จ
            return response()->json([
                'message' => 'อัปเดตข้อมูลไม่สำเร็จ',
                'code' => 500,
                'error' => $e->getMessage(),
            ], 500);
        }
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

    public function userWithDatatable(Request $request)
    {
        $postData = $request->all();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page

        $columnIndex = isset($postData['order'][0]['column']) ? $postData['order'][0]['column'] : 0;
        $columnName = isset($postData['columns'][$columnIndex]['data']) ? $postData['columns'][$columnIndex]['data'] : '';
        $columnSortOrder = isset($postData['order'][0]['dir']) ? $postData['order'][0]['dir'] : 'asc';
        $searchValue = $postData['search']['value']; // Search value
        $param = [
            "columnName" => $columnName,
            "columnSortOrder" => $columnSortOrder,
            "searchValue" => $searchValue,
            "start" => $start,
            "rowperpage" => $rowperpage,
        ];

        $sherchField = [
            'name', 'email'
        ];
        $relationsship = [
            'role'
        ];
        // Total records
        $totalRecordswithFilter = $totalRecords = $this->user->getAll($param, $sherchField, $relationsship)->count();

        // Fetch records
        $records = $this->user->paginate($param, $sherchField, $relationsship);

        return [
            "aaData" => $records,
            "draw" => $draw,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
        ];
    }
}
