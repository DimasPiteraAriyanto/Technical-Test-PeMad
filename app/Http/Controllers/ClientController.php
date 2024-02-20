<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
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

        $clients = $this->clientRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());

        return view('clients.index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:clients,email',
            'phone' => 'required|string|max:25|unique:clients,phone',
            'account_holder' => 'max:50',
            'account_number' => 'max:25',
            'bank_name' => 'max:25',
            'address' => 'required|string|max:100',
        ]);

        // Create a new client using the repository
        $this->clientRepository->create($validateData);

        return Redirect::route('clients.index')->with('success', 'New client has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:clients,email,'.$client->id,
            'phone' => 'required|string|max:25|unique:clients,phone,'.$client->id,
            'account_holder' => 'max:50',
            'account_number' => 'max:25',
            'bank_name' => 'max:25',
            'address' => 'required|string|max:100',
        ];
        $validatedData = $request->validate($rules);

        if ($validatedData['email'] != $client->email) {
            $validatedData['email_verified_at'] = null;
        }

        // Update client using the repository
        $this->clientRepository->update($validatedData, $client);

        return Redirect::route('clients.index')->with('success', 'Client has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        // Delete client using the repository
        $this->clientRepository->delete($client);

        return Redirect::route('clients.index')->with('success', 'Client has been deleted!');
    }
}
