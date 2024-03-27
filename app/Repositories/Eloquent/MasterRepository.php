<?php

namespace App\Repositories\Eloquent;

use App\Models\Base;

use App\Repositories\MasterRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use TimWassenburg\RepositoryGenerator\Repository\BaseRepository;

class MasterRepository extends BaseRepository implements MasterRepositoryInterface
//ประกาศว่ารอบรับ Interface โดยเงือนไข Repository จะต้องมีเมธอดทั้งหมดที่ Interface กำหนดไว้
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    private function buildSearchQuery($query, $param, $searchFields)
    {
        if (isset($param['searchValue'])) {

            foreach ($searchFields as $field) {
                $query->orWhere($field, "like", '%' . $param['searchValue'] . '%');
            }
        }

        return $query;
    }

    public function paginate($param, ?array $searchFields = null, ?array $withRelations = null): Collection
    {
        $query = $this->model->orderBy($param['columnName'], $param['columnSortOrder']);

        $query = $this->buildSearchQuery($query, $param, $searchFields);
        // If $withRelations is provided, add the with clauses to the query
        if ($withRelations !== null && is_array($withRelations)) {
            $query->with($withRelations);
        }
        return $query->skip($param['start'])
            ->take($param['rowperpage'])
            ->get();
    }

    public function getAll($param, ?array $searchFields = null, ?array $withRelations = null): Collection
    {
        $query = $this->model->orderBy($param['columnName'], $param['columnSortOrder']);

        $query = $this->buildSearchQuery($query, $param, $searchFields);
        // If $withRelations is provided, add the with clauses to the query
        if ($withRelations !== null && is_array($withRelations)) {
            $query->with($withRelations);
        }
        return $query->get();
    }
}
