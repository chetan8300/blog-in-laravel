<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    /*
    |----------------------------------------------------------------------
    | Application Routes
    |----------------------------------------------------------------------
    |
    | This route group applies the "web" middleware group to the every route
    | it contains. The "web" middleware group is defined in your HTTP
    | kernel and includes session state, CSRF protection, and more.
    |
    */

use App\Post;
use Illuminate\Support\Facades\Input;


Auth::routes();

Route::group([ 'middleware' => ['web']], function () {

	// Categories
	Route::resource('categories', 'CategoryController', ['except' => ['create']]);

	// Tags
	Route::resource('tags', 'TagController', ['except' => ['create']]);

	//Comments
	Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
	Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit', 'as' => 'comments.edit']);
	Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
	Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);

	//Search
	Route::any('/search', function(){
		$search = Input::get ( 'search' );
		$results = Post::where('title','LIKE','%'.$search.'%')->get();
		if(count($results) > 0) {
			return view( 'search' )->withResults( $results )->withQuery( $search );
		}
		else {
			return view ('search')->withMessage('No Details found. Try to search again !');
		}
	});

	Route::get('blog/{slug}', ['uses' => 'BlogController@getSingle', 'as' => 'blog.single'])->where('slug', '[\w\d\-\_]+');

    Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);

    Route::get('contact', ['uses' => 'PagesController@getContact', 'as' => 'pages.contact']);

	Route::post('contact', 'PagesController@postContact');

    Route::get('about', 'PagesController@getAbout');

    Route::get('/', 'PagesController@getIndex');

    Route::resource('posts', 'PostController');

});


