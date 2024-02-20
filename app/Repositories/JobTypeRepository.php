<?php

namespace App\Repositories;

use App\Models\Job;
use App\Models\JobType;

class JobTypeRepository
{
    protected $model;

    public function __construct(JobType $jobType)
    {
        $this->model = $jobType;
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
        $query = JobType::query();

        if(isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        return JobType::create($data);
    }

    public function update(array $data, JobType $jobType)
    {
        // Update jobType data
        $jobType->update($data);

        return $jobType;
    }

    public function destroy (JobType $jobType)
    {
        $jobType->delete();
    }

}
