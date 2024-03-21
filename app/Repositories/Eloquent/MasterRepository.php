<?php

namespace App\Repositories\Eloquent;

use App\Models\Base;
use App\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;

class MasterRepository extends BaseRepository implements BaseRepositoryInterface
//ประกาศว่ารอบรับ Interface โดยเงือนไข Repository จะต้องมีเมธอดทั้งหมดที่ Interface กำหนดไว้
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
