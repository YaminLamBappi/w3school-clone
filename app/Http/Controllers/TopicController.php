<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TopicController extends Controller
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
        $languages = Language::get();
        return view("admin.AddTopic", compact("languages"));
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "language_slug" => "required",
        ]);


        $lastSequence = Topic::where('language_slug', $request->language_slug)->max('sequence');

        $topic = new Topic();
        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->sequence = $lastSequence + 1;
        $topic->language_slug = $request->language_slug;
        $topic->slug = Str::slug($request->title);

        $topic->save();

        return redirect()->route("show.topic");
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        $languages = Language::get();

        $topics = Topic::with('language')->paginate(8);
        return view('admin.TopicList', compact("languages", "topics"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $topic = Topic::where('slug', $slug)->firstOrFail();
        $languages = Language::get();

        return view("admin.EditTopic", compact("topic", "languages"));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        // Find the topic by slug
        $topic = Topic::where('slug', $slug)->firstOrFail();

        // Validate the input data
        $request->validate([
            "title" => "required",
            "description" => "required",
            "sequence" => "required",
            "language_slug" => "required|exists:languages,slug"
        ]);

        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->sequence = $request->sequence;
        $topic->slug = Str::slug($request->title);

        $topic->language_slug = $request->language_slug;
        $topic->save();

        return redirect()->route('show.topic');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $topic = Topic::where('slug', $slug)->firstOrFail();
        $topic->delete();
        return redirect()->route('show.topic');
        //
    }
}
