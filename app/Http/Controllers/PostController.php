<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Post;
use Storage;
use Session;
use Purifier;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
    }

	public function index()
    {
        // create a variable and store all blog post in it from the database
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        // return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::all();
    	$tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate The Data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
	        'body'          => 'required',
	        'featured_image' => 'sometimes|image'
        ));

        // Store In The Database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
	    $post->category_id = $request->category_id;
        $post->body  = Purifier::clean($request->body);

        //save image to public folder and add path to database
	    if($request->hasFile('featured_image'))
	    {
	    	$image = $request->file('featured_image');

	    	$fileName = time() . '.' . $image->getClientOriginalExtension();

	    	$location = public_path('images/'. $fileName);

	    	Image::make($image)->resize(800, 400)->save($location);

	    	$post->image = $fileName;
	    }

        $post->save();

        $post->tags()->sync($request->tags, false);

        // To Show Flash Message To User Using Session
        Session::flash('success','The Blog Post Was Successfully Created!');

        // Redirect To Another Page
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the post in the database using id and save it as database
        $post = Post::find($id);

        // Find Category for particular post from database
        $categories = Category::all();
		$all_tags = Tag::all();

        $cats = array();
        foreach ($categories as $category)
        {
			$cats[$category->id] = $category->name;
        }

        $tags = array();
        foreach ($all_tags as $single_tag)
        {
        	$tags[$single_tag->id] = $single_tag->name;
        }

        // return the view and pass in the variable on created variable

        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags);
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
	    $post = Post::find($id);

        // Validate The Data

		$this->validate($request, array(
			'title' => 'required|max:255',
			'category_id'   => 'required|integer',
			'slug'  =>  "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
			'body'  =>  'required',
			'featured_image' => 'sometimes|image'
		));


        // Save The Data to Database


        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
	    $post->category_id = $request->input('category_id');
        $post->body  = Purifier::clean($request->input('body'));

        if($request->hasFile('featured_image')) {
	        // add new photo
	        $image = $request->file('featured_image');

	        $fileName = time() . '.' . $image->getClientOriginalExtension();

	        $location = public_path('images/'. $fileName);

	        Image::make($image)->resize(800, 400)->save($location);

        	// Delete old photo
	        $oldFileName = $post->image;
	        Storage::delete($oldFileName);

	        // Update the database
	        $post->image = $fileName;
        }

        $post->save();

        if(isset($request->tags)) {
	        $post->tags()->sync($request->tags);
        } else {
	        $post->tags()->sync(array());
        }

        // Set Flash data with success message
        Session::flash('success','The Post Was Successfully Updated!');

        // Redirect To the view posts.show with Flash message
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->tags()->detach();

        Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The Post was successfully deleted');

        return redirect()->route('posts.index');
    }
}
