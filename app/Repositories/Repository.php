<?php

namespace App\Repositories;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Modules\Basic\Repositories\RepositoryInterface;

abstract class Repository 
{
    protected Model $model;
    protected $query;

    abstract public function model(): string;

    public function __construct()
    {
        $this->model = app($this->model());
        $this->query = $this->model->query();

    }

    public function getById(int $id)
    {
        return $this->model->select('*')->findOrFail($id);
    }

    public function get()
    {
        return $this->model->get('*');
    }

    public function create(array $data) : Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data) : Model
    {
        $model = $this->model->findOrFail($id);

        if(!$model -> update($data)){
            throw new Exception();
        }

        return $model->refresh();
    }

    public function delete (int $id) : bool
    {
        $model = $this->model->findOrFail($id);

        if(!$model->delete())
        {
            return false;
        }

        return true;
    }

   
}