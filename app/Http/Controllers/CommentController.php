<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Session;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        // Validate the Request
        $this->validate($request, [
          'name' => 'required|max:255',
          'email' => 'required|email|max:255',
          'comment' => 'required|min:5|max:2000'
        ]);

        $comment = new Comment;

        $post = Post::find($post_id);

        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->post()->associate($post);
        $comment->approved = false;

        $comment->save();

        Session::flash('success', 'Comment was added. It has to be approved by our administrator.');

        return redirect()->route('blog.single', [$post->slug]);

    }

    /**
     * Accept the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $comment = Comment::find($id);

        $comment->approved = true;

        $comment->save();

        Session::flash('success', 'Comment has been approved');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
