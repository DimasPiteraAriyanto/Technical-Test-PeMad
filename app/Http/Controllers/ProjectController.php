<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Project;
use App\Repositories\JobRepository;
use App\Repositories\JobTypeRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{

    protected $projectRepository, $jobRepository, $jobTypeRepository;

    public function __construct(ProjectRepository $projectRepository,JobRepository $jobRepository, JobTypeRepository $jobTypeRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->jobRepository = $jobRepository;
        $this->jobTypeRepository = $jobTypeRepository;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $projects = $this->projectRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());


        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobTypes = $this->jobTypeRepository->all();
        $jobs = $this->jobRepository->all();
        return view('projects.create', compact('jobTypes', 'jobs'));
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name_project' => 'required|string|max:50',
            'job_id' => 'required|string|max:50',
            'start_date_project' => 'required|date',
            'end_date_project' => 'required|date|after:start_date_project',
            'price_project' => 'required|numeric',
            'detail_project' => 'nullable|string',
        ]);

        // Create a new job type using the repository
        $this->projectRepository->create($validateData);

        return Redirect::route('projects.index')->with('success', 'New Project  has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $jobTypes = $this->jobTypeRepository->all();
        $jobs = $this->jobRepository->all();

        return view('projects.edit', [
            'project' => $project,
            'jobs' => $jobs,
            'jobTypes' => $jobTypes
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $rules = [
            'name_project' => 'required|string|max:50',
            'job_id' => 'required|string|max:50',
            'start_date_project' => 'required|date',
            'end_date_project' => 'required|date|after:start_date_project',
            'price_project' => 'required|numeric',
            'detail_project' => 'nullable|string',
        ];
        $validatedData = $request->validate($rules);

        // Update client using the repository
        $this->projectRepository->update($validatedData, $project);

        return Redirect::route('projects.index')->with('success', 'Project  has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete client using the repository
        $this->projectRepository->destroy($project);

        return Redirect::route('projects.index')->with('success', 'Project  has been deleted!');
    }
}
