<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Repositories\BillRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\ServiceOfferingRepository;
use App\Repositories\ServiceRequestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BillController extends Controller
{

    protected  $projectRepository, $serviceRequestRepository, $serviceOfferingRepository, $billRepository;

    public function __construct(ServiceOfferingRepository $serviceOfferingRepository,ProjectRepository $projectRepository, ServiceRequestRepository $serviceRequestRepository, BillRepository $billRepository)
    {
        $this->serviceOfferingRepository = $serviceOfferingRepository;
        $this->serviceRequestRepository = $serviceRequestRepository;
        $this->projectRepository = $projectRepository;
        $this->billRepository = $billRepository;
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

        $bills = $this->billRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());


        return view('bills.index', [
            'bills' => $bills,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = $this->projectRepository->all();
        $serviceOfferings = $this->serviceOfferingRepository->all();
        $serviceRequests = $this->serviceRequestRepository->all();
        return view('bills.create', compact( 'projects', 'serviceOfferings', 'serviceRequests'));
    }

    public function store(Request $request)
    {
//        dd($request->all());

        $validateData = $request->validate([
            'project_id' => 'nullable|string|max:255',
            'service_request_id' => 'nullable|string|max:255',
            'service_offering_id' => 'nullable|string|max:255',
            'total_price' => 'required|integer',
            'status_bill' => 'required|string|max:255',
        ]);

        // Create a new job type using the repository
        $this->billRepository->create($validateData);

        return Redirect::route('bills.index')->with('success', 'New Bill  has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {


        $projects = $this->projectRepository->all();
        $serviceOfferings = $this->serviceOfferingRepository->all();
        $serviceRequests = $this->serviceRequestRepository->all();

        return view('bills.edit', [
            'bill' => $bill,
            'projects' => $projects,
            'serviceRequests' => $serviceRequests,
            'serviceOfferings' => $serviceOfferings,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $rules = [
            'project_id' => 'nullable|string|max:255',
            'service_request_id' => 'nullable|string|max:255',
            'service_offering_id' => 'nullable|string|max:255',
            'total_price' => 'required|integer',
            'status_bill' => 'required|string|max:255',
        ];
        $validatedData = $request->validate($rules);

        // Update client using the repository
        $this->billRepository->update($validatedData, $bill);

        return Redirect::route('bills.index')->with('success', 'Bill  has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        // Delete client using the repository
        $this->billRepository->destroy($bill);

        return Redirect::route('bills.index')->with('success', 'Bill  has been deleted!');
    }
}
