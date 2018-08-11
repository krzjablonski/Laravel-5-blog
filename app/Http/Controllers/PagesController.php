<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactForm;
use App\Post;
use Session;

class PagesController extends Controller{
  public function getIndex(){

    $posts = Post::orderBy('id', 'desc')->take(4)->get();

    foreach($posts as $post){
      if(strlen($post->body) > 50){
        $post->body = substr($post->body, 0, stripos($post->body, " ", 250))."[...]";
      }

    }
    return view('pages.welcome')->withPosts($posts);
  }

  public function getAbout(){
    $first = 'Krzysztof';
    $last = 'Jablonski';

    $fullname = $first . " " . $last;
    $email = "krz.jablonski@gmail.com";
    $data = array();
    $data['email'] = $email;
    $data['fullname'] = $fullname;
    $data['title'] = 'About';
    return view('pages.about')->withData($data);
  }
  public function getContact(){
    $data = array();
    $data['title'] = 'Contact';
    return view('pages.contact')->withData($data);
  }

  public function postContact(Request $request){
    // validate
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'message' => 'required'
    ]);

    Mail::to('krz.jablonski@gmail.com')->send(new ContactForm($request));

    Session::flash('success', 'Your email was send!');

    return redirect()->route('contact');

  }
}
