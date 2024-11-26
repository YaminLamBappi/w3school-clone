<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Topic;
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
        $language->slug = Str::slug($request->name);

        $language->save();

        return redirect()->route('show.language');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $languages = Language::withCount('topic')->get();

        return view("admin/LanguageList", compact("languages"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $language = Language::where('slug', $slug)->firstOrFail();

        return view("admin.EditLanguage", compact("language"));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $language = Language::where('slug', $slug)->firstOrFail();

        $newName = $request->input('name');
        $language->name = $newName;
        $language->slug = Str::slug($newName);
        $language->save();

        Topic::where('language_slug', $slug)->update(['language_slug' => $language->slug]);

        return redirect()->route('show.language')->with('success', 'Language name updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $language = Language::findOrFail($slug);
        $language->delete();
        return redirect()->route("show.language");

        //
    }
}
