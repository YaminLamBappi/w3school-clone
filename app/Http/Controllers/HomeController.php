<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Topic;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view("home.public", compact("languages"));
        //
    }
    public function home($slug)
    {

        $languages = Language::all();

        $language = Language::where('slug', $slug)->firstOrFail();

        $topics = Topic::where('language_slug', $slug)->orderBy('sequence')->get();
        return view("home.home", compact("languages", "language", "topics"));
    }

    public function content($slug, $lslug)
    {
        $languages = Language::all();


        $content = Topic::where('slug', $slug)->first();

        $topics = Topic::where('language_slug', $lslug)->get();

        return view("home.content", compact("languages", "content", "topics"));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
