<?php


namespace App\Repositories;

use App\Models\RefrenceCompany;

class CompanyRepository
{

    protected $model;

    public function __construct(RefrenceCompany $company)
    {
        $this->model = $company;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function search($filters)
    {
        $query = RefrenceCompany::query();

        if (isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('name_company', 'like', '%' . $search . '%')
                ->orWhere('email_company', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {

        return RefrenceCompany::create($data);
    }

    public function update(array $data, RefrenceCompany $company)
    {

        // Update user data
        $company->update($data);

        return $company;
    }

    public function delete(RefrenceCompany $company)
    {

        // Delete the user
        $company->delete();
    }
}
