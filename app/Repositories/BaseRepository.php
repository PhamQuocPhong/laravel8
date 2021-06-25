<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function fetchAll()
    {
        return $this->model->active()->get();
    }

    //example  $orderBy = ["created_at" => "DESC"];
    public function fetchAllByCondition(array $condition, $orderBy = null)
    {

        if($orderBy)
        {
            $column = array_keys($orderBy)[0];
            $sort = $orderBy[$column];

            return $this->model->where($condition)->active()->orderBy($column, $sort)->get();
        }
        return $this->model->where($condition)->active()->get();
    }

    public function fetchByCondition(array $condition, $orderBy = null)
    {   
        if($orderBy)
        {
            $column = array_keys($orderBy)[0];
            $sort = $orderBy[$column];
            return $this->model->where($condition)->active()->orderBy($column, $sort)->first();
        }

        return $this->model->where($condition)->active()->first();
    }

    public function fetchPaging(array $condition, $itemPerpage = 15, $orderBy = null)
    {
        if($orderBy)
        {

            $column = array_keys($orderBy)[0];
            $sort = $orderBy[$column];

            return $this->model->where($condition)->active()->orderBy($column, $sort)->paginate($itemPerpage);
        }
        return $this->model->where($condition)->active()->paginate($itemPerpage);
    }

    public function fetch($id)
    {
        return $this->model->active()->find($id);
    }

    public function update($id, $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function updateOrCreate($condition, $data)
    {
        return $this->model->updateOrCreate($condition, $data);
    }

    public function store($data)
    {
        return  $this->model->create($data);
    }

    public function delete($id)
    {
        return $this->model->find($id);
    }

    public function softDeleted($id)
    {
        return $this->model->find($id)->delete();
    }


    public function getCount()
    {
        return $this->model->active()->count();
    }

    public function fetchTrash($id)
    {
        return $this->model->withTrashed()->find($id);
    }

}
