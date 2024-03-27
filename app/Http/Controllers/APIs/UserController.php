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
