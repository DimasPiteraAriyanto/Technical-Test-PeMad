<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Repositories\JobRepository;
use App\Repositories\JobTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JobController extends Controller
{

    protected $jobRepository, $jobTypeRepository;

    public function __construct(JobRepository $jobRepository, JobTypeRepository $jobTypeRepository)
    {
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

        $jobs = $this->jobRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());


        return view('jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobTypes = $this->jobTypeRepository->all();
        return view('jobs.create', compact('jobTypes'));
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name_job' => 'required|string|max:50',
            'job_type_id' => 'required|string|max:50',
        ]);

        // Create a new job type using the repository
        $this->jobRepository->create($validateData);

        return Redirect::route('jobs.index')->with('success', 'New Job  has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $jobTypes = $this->jobTypeRepository->all();

        return view('jobs.edit', [
            'job' => $job,
            'jobTypes' => $jobTypes
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $rules = [
            'name_job' => 'required|string|max:50',
            'job_type_id' => 'required|string|max:50',
        ];
        $validatedData = $request->validate($rules);

        // Update client using the repository
        $this->jobRepository->update($validatedData, $job);

        return Redirect::route('jobs.index')->with('success', 'Job  has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        // Delete client using the repository
        $this->jobRepository->destroy($job);

        return Redirect::route('jobs.index')->with('success', 'Job  has been deleted!');
    }
}
