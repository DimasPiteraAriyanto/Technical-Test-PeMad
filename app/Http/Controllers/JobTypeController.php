<?php

namespace App\Http\Controllers;

use App\Models\JobType;
use App\Repositories\JobTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JobTypeController extends Controller
{
    protected $jobTypeRepository;

    public function __construct(JobTypeRepository $jobTypeRepository)
    {
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

        $jobTypes = $this->jobTypeRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());


        return view('jobTypes.index', [
            'jobTypes' => $jobTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobTypes.create');
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name_type_job' => 'required|string|max:50',
        ]);

        // Create a new job type using the repository
        $this->jobTypeRepository->create($validateData);

        return Redirect::route('jobTypes.index')->with('success', 'New Job Type has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobType $jobType)
    {
        return view('jobTypes.edit', [
            'jobType' => $jobType
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobType $jobType)
    {
        $rules = [
            'name_type_job' => 'required|string|max:50',
        ];
        $validatedData = $request->validate($rules);

        // Update client using the repository
        $this->jobTypeRepository->update($validatedData, $jobType);

        return Redirect::route('jobTypes.index')->with('success', 'Job Type has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobType $jobType)
    {
        // Delete client using the repository
        $this->jobTypeRepository->destroy($jobType);

        return Redirect::route('jobTypes.index')->with('success', 'Job Type has been deleted!');
    }

}
