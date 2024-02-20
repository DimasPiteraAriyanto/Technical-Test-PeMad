<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Repositories\CompanyRepository;
use App\Repositories\JobRepository;
use App\Repositories\ServiceRequestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ServiceRequestController extends Controller
{

    protected  $jobRepository, $companyRepository, $serviceRequestRepository;

    public function __construct(ServiceRequestRepository $serviceRequestRepository,JobRepository $jobRepository, CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->jobRepository = $jobRepository;
        $this->serviceRequestRepository = $serviceRequestRepository;
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

        $serviceRequests = $this->serviceRequestRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());


        return view('serviceRequests.index', [
            'serviceRequests' => $serviceRequests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jobs = $this->jobRepository->all();
        $companies = $this->companyRepository->all();
        return view('serviceRequests.create', compact( 'jobs', 'companies'));
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $validateData = $request->validate([
            'job_id' => 'required|string|max:50',
            'company_id' => 'required|string|max:50',
            'name_service_request' => 'required|string|max:255',
            'start_date_service_request' => 'required|date',
            'end_date_service_request' => 'required|date|after_or_equal:start_date_service_request',
            'price_service_request' => 'required|integer',
            'detail_service_request' => 'required|string',
        ]);

        // Create a new job type using the repository
        $this->serviceRequestRepository->create($validateData);

        return Redirect::route('serviceRequests.index')->with('success', 'New Service Offering  has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceRequest $serviceRequest)
    {

        $jobs = $this->jobRepository->all();
        $companies = $this->companyRepository->all();

        return view('serviceRequests.edit', [
            'serviceRequest' => $serviceRequest,
            'jobs' => $jobs,
            'companies' => $companies,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceRequest $serviceRequest)
    {
        $rules = [
            'job_id' => 'required|string|max:50',
            'company_id' => 'required|string|max:50',
            'name_service_request' => 'required|string|max:255',
            'start_date_service_request' => 'required|date',
            'end_date_service_request' => 'required|date|after_or_equal:start_date_service_request',
            'price_service_request' => 'required|integer',
            'detail_service_request' => 'required|string',
        ];
        $validatedData = $request->validate($rules);

        // Update client using the repository
        $this->serviceRequestRepository->update($validatedData, $serviceRequest);

        return Redirect::route('serviceRequests.index')->with('success', 'Service Request  has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceRequest $serviceRequest)
    {
        // Delete client using the repository
        $this->serviceRequestRepository->destroy($serviceRequest);

        return Redirect::route('serviceRequests.index')->with('success', 'Service Request  has been deleted!');
    }
}
