<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
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
        $query = User::query();

        if(isset($filters['search'])) {
            $search = $filters['search'];
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function create(array $data)
    {
        // Handle file upload
        if (isset($data['photo'])) {
            $fileName = $data['photo']->store('public/profile');
            $data['photo'] = basename($fileName);
        }

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    protected function uploadPhoto($file)
    {
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $path = 'public/profile/';
        $file->storeAs($path, $fileName);
        return $fileName;
    }

    public function update(array $data, User $user)
    {
        // Handle file upload
        if (isset($data['photo'])) {
            $fileName = $data['photo']->store('public/profile');
            $data['photo'] = basename($fileName);

            // Delete existing photo if it exists
            if ($user->photo) {
                Storage::delete('public/profile/' . $user->photo);
            }
        }

        // Update user data
        $user->update($data);

        return $user;
    }

    public function updatePassword(string $username, string $password)
    {
        User::where('username', $username)->update([
            'password' => Hash::make($password)
        ]);
    }

    public function delete(User $user)
    {
        // Delete user's photo if exists
        if ($user->photo) {
            Storage::delete('public/profile/' . $user->photo);
        }

        // Delete the user
        $user->delete();
    }
}
