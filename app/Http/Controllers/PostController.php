<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
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

      // Get all categories
      $categories = Category::all();

      // Get all Tags
      $tags = Tag::all();

      // Create category array where key is category id and value is name of category. It will be used to output <select> in posts.create view using HTML facade
      $categoriresArr = array();
      foreach ($categories as $category) {
        $categoriresArr[$category->id] = $category->category_name;
      }

        // Create tags array where key is tag id and value is name of tag. It will be used to output <select> in posts.create view using HTML facade
      $tagsArr = array();
      foreach($tags as $tag){
        $tagsArr[$tag->id] = $tag->tag_name;
      }

      // Return view with categories and tags
      return view('posts.create')->withCategories($categoriresArr)->withTags($tagsArr);
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

    $category = Category::find($request->category_id);

    // store in database
    $post = new Post;
    $post->title = $request->title;
    $post->slug = $request->slug;
    $post->category()->associate($category);
    $post->body = $request->body;

    $post->save();

    $post->tags()->sync($request->tags, false);

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
    // Get single post by id
    $post = Post::find($id);

    // Get all categories
    $categories = Category::all();

    // Get all Tags
    $tags = Tag::all();

    // Create category array where key is category id and value is name of category. It will be used to output <select> in posts.create view using HTML facade
    $categoriresArr = array();
    foreach ($categories as $category) {
      $categoriresArr[$category->id] = $category->category_name;
    }

      // Create tags array where key is tag id and value is name of tag. It will be used to output <select> in posts.create view using HTML facade
    $tagsArr = array();
    foreach($tags as $tag){
      $tagsArr[$tag->id] = $tag->tag_name;
    }

    return view('posts.edit')->withPost($post)->withCategories($categoriresArr)->withTags($tagsArr);
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

      if(isset($request->tags)){
        $post->tags()->sync($request->tags, true);
      }else{
        $post->tags()->sync(array());
      }

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

      // Deatach all bidnings to tagas
      $post->tags()->detach();

      $post->delete();

      Session::flash('success', 'The post was deleted');

      return redirect()->route('posts.index');

  }
}
