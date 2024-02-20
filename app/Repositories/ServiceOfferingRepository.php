<?php

namespace App\Repositories;

use App\Models\ServiceOffering;

class ServiceOfferingRepository
{
    protected $model;

    public function __construct(ServiceOffering $serviceOffering)
    {
        $this->model = $serviceOffering;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getId($id)
    {
        $this->model->findOrFail($id);
    }

    public function search($filters)
    {
        $query = ServiceOffering::query();

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('company_id', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        return ServiceOffering::create($data);
    }

    public function update(array $data, ServiceOffering $serviceOffering)
    {
        // Update serviceOffering data
        $serviceOffering->update($data);

        return $serviceOffering;
    }

    public function destroy(ServiceOffering $serviceOffering)
    {
        $serviceOffering->delete();
    }
}
