<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
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
      $categories = Category::all();
      $categoriresArr = array();
      foreach ($categories as $category) {
        $categoriresArr[$category->id] = $category->category_name;
      }
      return view('posts.create')->withCategories($categoriresArr);
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
      'category_id' => 'required|integer',
      'body' => 'required'
    ));
    // store in database
    $post = new Post;
    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->category_id = $request->category_id;
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
    $categories = Category::all();
    $categoriresArr = array();
    foreach ($categories as $category) {
      $categoriresArr[$category->id] = $category->category_name;
    }
      $post = Post::find($id);
      return view('posts.edit')->withPost($post)->withCategories($categoriresArr);
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

      // find post
      $post = Post::find($id);

      // Validate request. If slug has not changed do not validate it. Otherwise it will cause error
      if($request->slug == $post->slug){
        $this->validate($request, array(
          'title' => 'required|max:255',
          'category_id' => 'required|integer',
          'body' => 'required'
        ));
      }else{
        $this->validate($request, array(
          'title' => 'required|max:255',
          'slug' => 'required|alpha_dash|max:255|unique:posts,slug',
          'category_id' => 'required|integer',
          'body' => 'required'
        ));
      }


      // update properties of post obj in database

      $post->title = $request->title;
      $post->slug = $request->slug;
      $post->category_id = $request->category_id;
      $post->body = $request->body;


      // update data to database
      $post->save();

      // Send flash message
      Session::flash('success', 'This post was successfully updated.');

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
