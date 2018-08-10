<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Session;

class TagController extends Controller
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
        $tags = Tag::orderBy('id', 'dsc')->get();
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
        // validate
        $this->validate($request, [
          'tag_name' => 'required|max:255|unique:tags,tag_name'
        ]);

        // create new instance of Tag class
        $tag = new Tag;
        $tag->tag_name = $request->tag_name;

        // Save this obj to database
        $tag->save();

        // Return to view with flash info
        Session::flash('success', 'Tag was successfully added');
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
        // find object
        $tag = Tag::find($id);

        // validate
        $this->validate($request, [
          'tag_name' => 'required|max:255|unique:tags,tag_name'
        ]);

        // update object
        $tag->tag_name = $request->tag_name;

        // save it to db
        $tag->save();

        // redirect to index with flash message
        Session::flash('success', 'Tag was successfully updated');
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find tag in database
        $tag = Tag::find($id);

        // Detach all bindings to Posts
        $tag->posts()->detach();
        
        // run delete method to delete selected record
        $tag->delete();

        // return view with flash message
        Session::flash('success', 'Tag was successfully deleted');
        return redirect()->route('tags.index');

    }
}
