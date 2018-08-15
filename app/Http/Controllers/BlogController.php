<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
  public function getIndex(){
    $posts = Post::orderBy('id', 'desc')->paginate(10);

    foreach($posts as $post){
      if(strlen($post->body) > 250){
        $post->body = substr(strip_tags($post->body), 0, strpos(strip_tags($post->body), " ", 250)).'[...]';
      }
    }

    return view('blog.index')->withPosts($posts);
  }


  public function getSingle($slug){

    // fetch from database based on slug
    $post = Post::where('slug', '=', $slug)->first();

    // return view with post database
     return view('blog.single')->withPost($post);
  }
}
