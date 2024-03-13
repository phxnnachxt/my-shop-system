<?php

// namespace ระบุชื่อพื้นที่ของคลาส
namespace App\Repositories\Eloquent;

// use นำ Model ที่ใช้มาใช้งาน
use App\Models\Base;

// use อินเทอร์เฟซ BaseRepositoryInterface มาใช้งาน
use App\Repositories\BaseRepositoryInterface;

// use Model จาก Eloquent ORM มาใช้งาน
use Illuminate\Database\Eloquent\Model;

// use Collection จาก Laravel Support มาใช้งาน
use Illuminate\Support\Collection;

/**
 * Class BaseRepository.
 * คลาส BaseRepository ทำหน้าที่เป็นคลาสพื้นฐานสำหรับการจัดการข้อมูลกับ Eloquent ORM
 */
class BaseRepository implements BaseRepositoryInterface
//ประกาศว่ารอบรับ Interface โดยเงือนไข Repository จะต้องมีเมธอดทั้งหมดที่ Interface กำหนดไว้
{
    /**
     * ตัวแปร $model เก็บโมเดล Eloquent ที่ใช้สำหรับการจัดการข้อมูล
     *
     * @var Model
     */
    protected $model;

    /**
     * Constructor ของคลาส BaseRepository
     *
     * @param Model $model โมเดล Eloquent ที่ใช้สำหรับการจัดการข้อมูล
     */
    public function __construct(Model $model)
    {
        // กำหนดค่าโมเดลให้กับตัวแปร $model
        $this->model = $model;
    }

    //select * from
    public function all()
    {
        return $this->model->all();
    }
    //select * from where id = x
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
    //insert into model (x) values (y)
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }
    //update model set x=y where id = z
    public function update($id, array $data): Model
    {
        $model = $this->model->find($id);
        $model->update($data);
        return $model;
    }
    // delete model where id = x
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}
