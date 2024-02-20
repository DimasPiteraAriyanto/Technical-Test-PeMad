<?php

namespace App\Repositories;

use App\Models\ServiceRequest;

class ServiceRequestRepository
{
    protected $model;

    public function __construct(ServiceRequest $serviceRequest)
    {
        $this->model = $serviceRequest;
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
        $query = ServiceRequest::query();

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('company_id', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        return ServiceRequest::create($data);
    }

    public function update(array $data, ServiceRequest $serviceRequest)
    {
        // Update serviceRequest data
        $serviceRequest->update($data);

        return $serviceRequest;
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        $serviceRequest->delete();
    }
}
