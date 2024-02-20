<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository
{

    protected $model;

    public function __construct(Job $job)
    {
        $this->model = $job;
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
        $query = Job::query();

        if(isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('name_job', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        return Job::create($data);
    }

    public function update(array $data, Job $job)
    {
        // Update job data
        $job->update($data);

        return $job;
    }

    public function destroy (Job $job)
    {
        $job->delete();
    }
}
