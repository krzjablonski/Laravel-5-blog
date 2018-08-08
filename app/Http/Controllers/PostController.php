<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;

class PostController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      // get all posts from posts table
      $posts = Post::orderBy('id', 'desc')->paginate(10);
      foreach($posts as $post){
        if(strlen($post->body) > 50){
          $post->body = substr($post->body, 0, stripos($post->body, ".", 0))."[...]";
        }
      }

      // Pass posts to view
      return view('posts.index')->withPosts($posts);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('posts.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // validate the data
    $this->validate($request, array(
      'title' => 'required|max:255',
      'slug' => 'required|alpha_dash|max:255|unique:posts,slug',
      'body' => 'required'
    ));
    // store in database
    $post = new Post;
    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->body = $request->body;

    $post->save();

    // Send info for user via flash session
    Session::flash('success', 'The blog post was successfully created!');

    // redirect to Show
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
      $post = Post::find($id);
      return view('posts.edit')->withPost($post);
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

      // Validate request
      $this->validate($request, array(
        'title' => 'required|max:255',
        'slug' => 'required|alpha_dash|max:255|unique:posts,slug',
        'body' => 'required'
      ));

      // Find post
      $post = Post::find($id);

      // update properties of post obj in database

      $post->title = $request->title;
      $post->slug = $request->slug;
      $post->body = $request->body;


      // update data to database
      $post->save();

      // Send flash message
      Session::flash('success', 'This post was successfully saved.');

      // redirect to view
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

      $post->delete();

      Session::flash('success', 'The post was deleted');

      return redirect()->route('posts.index');

  }
}
