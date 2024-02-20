<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class ClientRepository {

    protected $model;

    public function __construct(Client $client)
    {
        $this->model = $client;
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
        $query = Client::query();

        if(isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        // Handle file upload
        if (isset($data['photo'])) {
            $fileName = $data['photo']->store('public/client');
            $data['photo'] = basename($fileName);
        }

        return Client::create($data);
    }

    protected function uploadPhoto($file)
    {
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $path = 'public/client/';
        $file->storeAs($path, $fileName);
        return $fileName;
    }

    public function update(array $data, Client $client)
    {
        // Handle file upload
        if (isset($data['photo'])) {
            $fileName = $data['photo']->store('public/client');
            $data['photo'] = basename($fileName);

            // Delete existing photo if it exists
            if ($client->photo) {
                Storage::delete('public/client/' . $client->photo);
            }
        }

        // Update user data
        $client->update($data);

        return $client;
    }

    public function delete(Client $client)
    {
        // Delete user's photo if exists
        if ($client->photo) {
            Storage::delete('public/client/' . $client->photo);
        }

        // Delete the user
        $client->delete();
    }
}
