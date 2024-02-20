<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    protected $model;

    public function __construct(Project $project)
    {
        $this->model = $project;
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
        $query = Project::query();

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('name_project', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function update(array $data, Project $project)
    {
        // Update project data
        $project->update($data);

        return $project;
    }

    public function destroy(Project $project)
    {
        $project->delete();
    }
}
