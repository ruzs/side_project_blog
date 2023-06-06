<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function get()
    {
        return $this->model->get();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAllWithTrashed()
    {
        return $this->model->withTrashed()->get();
    }

    public function getAllPaginated($count)
    {
        return $this->model->paginate($count);
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getByIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function getByUUID($uuid)
    {
        return $this->model->where("uuid", $uuid)->first();
    }

    public function getAllByUUID($uuid)
    {
        return $this->model->where("uuid", $uuid)->get();
    }

    public function getOnlineByUUID($uuid)
    {
        return $this->model->where("uuid", $uuid)->where('online', config('constants.online.enabled'))->first();
    }

    public function getOnlineById($id)
    {
        return $this->model->where('online', config('constants.online.enabled'))->find($id);
    }

    public function getOfflineById($id)
    {
        return $this->model->where('online', config('constants.online.disabled'))->find($id);
    }    

    public function getFirst()
    {
        return $this->model->first();
    }

    public function getLatest()
    {
        return $this->model->latest('created_at')->first();
    }

    public function getAllById($id)
    {
        return $this->model->withTrashed()->find($id);
    }

    public function count()
    {
        return $this->model->count();
    }

    public function countAll()
    {
        return $this->model->withTrashed()->count();
    }

    public function getNew($attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    public function save($data)
    {
        if ($data instanceOf Model){
            return $this->update($data);
        } elseif (is_array($data)){
            return $this->storeArray($data);
        }
    }

    public function saveMany($data)
    {
        return $this->model->insert($data);
    }

    protected function storeEloquentModel($model)
    {
        if ($model->getDirty()){
            $model->save();
        } else {
            $model->touch();
        }
        return $model;
    }

    protected function storeArray($data)
    {
        $model = $this->getNew($data);
        return $this->storeEloquentModel($model);
    }

    public function deleteAll()
    {
        $this->model->query()->delete();
    }

    public function deleteById($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function delIds($data)
    {
        return $this->model->whereIn('id', $data)
                           ->delete();
    }

    public function delExceptIds($data)
    {
        return $this->model->whereNotIn('id', $data)
                           ->delete();
    }

    // 取得最大的排序
    public function getNewSort()
    {
        return $this->model->max('sort') + 1;
    }

    // 取得所有Online
    public function getOnline()
    {
        return $this->model->where('online', config('constants.online.enabled'))->get();
    }

    // 取得所有Offline
    public function getOffline()
    {
        return $this->model->where('online', config('constants.online.disabled'))->get();
    }
}