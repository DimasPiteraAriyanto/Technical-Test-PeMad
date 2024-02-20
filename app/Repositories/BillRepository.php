<?php

namespace App\Repositories;


use App\Models\Bill;
use App\Models\Project;

class BillRepository
{
    protected $model;

    public function __construct(Bill $bill)
    {
        $this->model = $bill;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getId($id)
    {
        return $this->model->findOrFail($id);
    }

    public function search($filters)
    {
        $query = BIll::query();

        if(isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('name_project', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        return Bill::create($data);
    }

    public function update(array $data, Bill $bill)
    {
        // Update bill data
        $bill->update($data);

        return $bill;
    }

    public function delete(Bill $bill)
    {
        $bill->delete();
    }

}
