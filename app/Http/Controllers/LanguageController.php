<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.AddLanguage");
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);

        $language = new Language();
        $language->name = $request->name;

        $language->save();

        return redirect()->route('show.language');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        $languages = Language::withCount('topic')->get();

        return view("admin/LanguageList", compact("languages"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $language = Language::findOrFail($id);

        return view("admin.EditLanguage", compact("language"));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->name = $request->name;
        $language->save();
        return redirect()->route("show.language");
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        $language->delete();
        return redirect()->route("show.language");

        //
    }
}
