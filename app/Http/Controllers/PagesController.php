<?php

namespace App\Http\Controllers;
use App\Post;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;

class PagesController extends Controller {

    public function getIndex() {

        $posts = Post::orderBy('created_at','desc')->limit(4)->get();

        return view('pages.welcome')->withPosts($posts);
    }

    public function getAbout() {
        $first = "Chetan";
        $last = "Godhani";
        $fullname = $first.' '.$last;
	    $email = "chetangodhani@gmail.com";
	    $data = [];
	    $data['email'] = $email;
	    $data['fullname'] = $fullname;
	    return view('pages.about')->withData($data);
    }

    public function getContact() {
        return view('pages.contact');
    }

	public function postContact(Request $request) {
		$this->validate($request, array(
			'email' => 'required|email|max:255',
			'subject'   => 'required|min:3',
			'message'  =>  'required|min:10'
		));

		$data = array(
			'email'     =>  $request->email,
			'subject'   =>  $request->subject,
			'messageBody'   =>  $request->message
		);


		Mail::send('emails.contact', $data, function ($message) use ($data) {
			$message->from($data['email']);
			$message->to('contact@laravelblog.com');
			$message->subject($data['subject']);
		});

		Session::flash('success','Message was send Successfully!');

		// Redirect To Another Page
		return redirect()->route('pages.contact');
    }

}
