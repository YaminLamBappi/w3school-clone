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
    public function home($id)
    {

        $languages = Language::all();

        $courses = Language::findOrFail($id);

        $topics = Topic::where('language_id', $id)->orderBy('sequence')->get();
        return view("home.home", compact("languages", "courses", "topics"));
    }

    public function content($id, $lid)
    {
        $languages = Language::all();
        $courses = Language::findorfail($lid);

        $content = Topic::where('id', $id)->first();

        $topics = Topic::where('language_id', $lid)->get();

        return view("home.content", compact("courses", "languages", "content", "topics"));
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
