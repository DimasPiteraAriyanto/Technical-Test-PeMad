<?php

namespace App\Repositories;


use App\Models\RefrenceLanguage;

class LanguageRepository
{
    protected $model;

    public function __construct(RefrenceLanguage $language)
    {
        $this->model = $language;
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
        $query = RefrenceLanguage::query();

        if(isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('name_language', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        return RefrenceLanguage::create($data);
    }

    public function update(array $data, RefrenceLanguage $language)
    {
        // Update language data
        $language->update($data);

        return $language;
    }

    public function delete(RefrenceLanguage $language)
    {
        $language->delete();
    }

}
