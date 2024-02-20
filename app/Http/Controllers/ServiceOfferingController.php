<?php

namespace App\Http\Controllers;

use App\Models\ServiceOffering;
use App\Repositories\CompanyRepository;
use App\Repositories\JobRepository;
use App\Repositories\ServiceOfferingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ServiceOfferingController extends Controller
{

    protected  $jobRepository, $companyRepository, $serviceOfferingRepository;

    public function __construct(ServiceOfferingRepository $serviceOfferingRepository,JobRepository $jobRepository, CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->jobRepository = $jobRepository;
        $this->serviceOfferingRepository = $serviceOfferingRepository;
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

        $serviceOfferings = $this->serviceOfferingRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());


        return view('serviceOfferings.index', [
            'serviceOfferings' => $serviceOfferings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobs = $this->jobRepository->all();
        $companies = $this->companyRepository->all();
        return view('serviceOfferings.create', compact( 'jobs', 'companies'));
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $validateData = $request->validate([
            'job_id' => 'required|string|max:50',
            'company_id' => 'required|string',
            'price_service_offerings' => 'required|string',
            'detail_service_offerings' => 'required|nullable',
        ]);

        // Create a new job type using the repository
        $this->serviceOfferingRepository->create($validateData);

        return Redirect::route('serviceOfferings.index')->with('success', 'New Service Offering  has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceOffering $serviceOffering)
    {

        $jobs = $this->jobRepository->all();
        $companies = $this->companyRepository->all();

        return view('serviceOfferings.edit', [
            'serviceOffering' => $serviceOffering,
            'jobs' => $jobs,
            'companies' => $companies,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceOffering $serviceOffering)
    {
        $rules = [
            'job_id' => 'required|string|max:50',
            'company_id' => 'required|string',
            'price_service_offerings' => 'required|string',
            'detail_service_offerings' => 'required|nullable',
        ];
        $validatedData = $request->validate($rules);

        // Update client using the repository
        $this->serviceOfferingRepository->update($validatedData, $serviceOffering);

        return Redirect::route('serviceOfferings.index')->with('success', 'Service Offering  has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceOffering $serviceOffering)
    {
        // Delete client using the repository
        $this->serviceOfferingRepository->destroy($serviceOffering);

        return Redirect::route('serviceOfferings.index')->with('success', 'Service Offering  has been deleted!');
    }
}
