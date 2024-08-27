<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getById(int $id, array $columns = ['*'], array $relations = [], array $append = []);
    public function get(array $columns = ['*'], array $relations = []) ;
    public function create(array $data): Model;
    public function update(int $id, array $data): Model;
    public function delete(int $id): bool;
}