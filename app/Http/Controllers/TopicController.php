<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Topic;
use Illuminate\Http\Request;

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
            "language_id" => "required",
        ]);
        $lastSequence = Topic::where('language_id', $request->language_id)->max('sequence');

        $topic = new Topic();
        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->sequence = $lastSequence + 1;
        $topic->language_id = $request->language_id;


        $topic->save();

        return redirect()->route("show.topic");


        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $topics = Topic::with('language')->paginate(8);
        return view('admin.TopicList', compact("topics"));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        $languages = Language::get();

        return view("admin.EditTopic", compact("topic", "languages"));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);

        $request->validate([
            "title" => "required",
            "description" => "required",
            "sequence" => "required",
            "language_id" => "required"
        ]);
        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->sequence = $request->sequence;
        $topic->language_id = $request->language_id;
        $topic->save();

        return redirect()->route('show.topic');


        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return redirect()->route('show.topic');
        //
    }
}
