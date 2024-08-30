<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeRepository
{
    public function model(): string
    {
        return Employee::class;
    }

    protected $query;

    public function find(string | null $keyword, string | null $department_code,$page,$pre_page)
    {
        // $this->query = Employee::query();
        $this->query = DB::table('employees');

        if ($department_code) {

            $this->query->where('dep_code', '=', $department_code);
        }

        //閉包(name like '%keyword%' or email like '%keyword%')
        if ($keyword) {
            $this->query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
                $query->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        $model = $this->query->join('departments', 'dep_code', '=', 'departments.code')
            ->select('employees.*', 'departments.name as dep_name')
            ->orderBy('employees.id', 'desc')
            ->paginate($pre_page, ['*'], 'page', $page);

        return $model;
    }
    public function add($data)
    {
        return Employee::create($data->all());
    }

    public function update($data)
    {
        $data->update();
    }

    public function list()
    {
        return Employee::all();
    }
    public function delete($data)
    {
        //delete data
        $data->delete();
    }

    public function login($email, $password)
    {
        return Employee::where('email', $email)->select('id', 'name', 'email', 'dep_code', 'password')->first();
    }   

    public function getById($id)
    {
        return Employee::findOrFail($id);
    }
}
