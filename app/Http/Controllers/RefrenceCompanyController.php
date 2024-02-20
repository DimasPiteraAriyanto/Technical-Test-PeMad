<?php

namespace App\Http\Controllers;

use App\Models\RefrenceCompany;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RefrenceCompanyController extends Controller
{

    protected $refrenceCompanyRepository;

    public function __construct(CompanyRepository $refrenceCompanyRepository)
    {
        $this->refrenceCompanyRepository = $refrenceCompanyRepository;
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

        $companies = $this->refrenceCompanyRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());


        return view('companies.index', [
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {

//        dd($request->all());
        $validateData = $request->validate([
            'name_company' => 'required|string|max:50',
            'email_company' => 'required|email|max:50',
            'phone_company' => 'required|string|max:50',
            'account_bank_company' => 'required|string|max:50',
        ]);


        // Create a new job type using the repository
        $this->refrenceCompanyRepository->create($validateData);

        return Redirect::route('companies.index')->with('success', 'New Company  has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RefrenceCompany $company)
    {
        return view('companies.edit', [
            'company' => $company,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RefrenceCompany $company)
    {
        $rules = [
            'name_company' => 'required|string|max:50',
            'email_company' => 'required|email|max:50',
            'phone_company' => 'required|string|max:50',
            'account_bank_company' => 'required|string|max:50',
        ];

        $validatedData = $request->validate($rules);

        // Update client using the repository
        $this->refrenceCompanyRepository->update($validatedData, $company);

        return Redirect::route('companies.index')->with('success', 'Company  has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RefrenceCompany $company)
    {
        // Delete client using the repository
        $this->refrenceCompanyRepository->delete($company);

        return Redirect::route('companies.index')->with('success', 'Company  has been deleted!');
    }
}
