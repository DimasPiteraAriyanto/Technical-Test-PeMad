<?php

namespace App\Http\Controllers;

use App\Models\RefrenceLanguage;
use App\Repositories\LanguageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RefrenceLanguageController extends Controller
{
    protected $languageRepository;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
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

        $languages = $this->languageRepository->search(request()->all())
            ->sortable()
            ->paginate($row)
            ->appends(request()->query());


        return view('languages.index', [
            'languages' => $languages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('languages.create');
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name_language' => 'required|string|max:50',
        ]);

        // Create a new job type using the repository
        $this->languageRepository->create($validateData);

        return Redirect::route('languages.index')->with('success', 'New Language has been created!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RefrenceLanguage $language)
    {
        return view('languages.edit', [
            'language' => $language
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RefrenceLanguage $language)
    {
        $rules = [
            'name_language' => 'required|string|max:50',
        ];
        $validatedData = $request->validate($rules);

        // Update client using the repository
        $this->languageRepository->update($validatedData, $language);

        return Redirect::route('languages.index')->with('success', 'Language has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RefrenceLanguage $language)
    {
        // Delete client using the repository
        $this->languageRepository->delete($language);

        return Redirect::route('languages.index')->with('success', 'Language has been deleted!');
    }

}
