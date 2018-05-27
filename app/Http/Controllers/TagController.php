<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class TagController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    // Display View of all Tags
	    // Form to create new tag

	    $tags = Tag::all();

	    return view('tags.index')->withTags($tags);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Save new tag and return to index page
    	// Store Tag into the database
	    $this->validate($request, array(
		    'name' => 'required|max:255',
	    ));

	    $tag = new Tag;

	    $tag->name = $request->name;
	    $tag->save();

	    // To Show Flash Message To User Using Session
	    Session::flash('success','Tag was added successfully!');

	    // Redirect To Another Page
	    return redirect()->route('tags.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Show the tag to update it
	    $tag = Tag::find($id);

	    return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $tag = Tag::find($id);

	    return view('tags.edit')->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    	$tag = Tag::find($id);

	    // Store Tag into the database
	    $this->validate($request, array(
		    'name' => 'required|max:255',
	    ));

	    $tag->name = $request->name;
	    $tag->save();

	    // To Show Flash Message To User Using Session
	    Session::flash('success','Tag was updated successfully!');

	    // Redirect To Another Page
	    return redirect()->route('tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);

        $tag->posts()->detach();

        $tag->delete();

	    Session::flash('success', 'Tag was successfully deleted');

	    return redirect()->route('tags.index');
    }
}
