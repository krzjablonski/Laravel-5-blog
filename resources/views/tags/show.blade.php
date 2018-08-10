@extends('layouts.main')
@section('title', $tag->tag_name)
@section('content')
  <div class="container mt-5">
    <div class="row mb-5">
      <div class="col-md-10">
        <h1>{{$tag->tag_name}}</h1>
      </div>
      <div class="col-md-2">
        {!! Html::linkRoute('tags.edit', 'Edit', [$tag->id], ['class'=>'btn btn-primary btn-block']) !!}
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped">
          <thead>
            <th>Id</th>
            <th>Title</th>
            <th>Body</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Created at</th>
            <th>Last update</th>
            <th></th>
          </thead>
          <tbody>
            @foreach($tag->posts as $post)
              <tr>
                <th>{{$post->id}}</th>
                <td>{!! Html::linkRoute('posts.show', $post->title, array($post->id), array()) !!}</td>
                <td>{{$post->body}}</td>
                <td>{{$post->category->category_name}}</td>
                <td>
                  @foreach($post->tags as $key => $tag)
                    @if($key == $post->tags->count()-1)
                      {{$tag->tag_name}}
                    @else
                      {{$tag->tag_name.' / '}}
                    @endif
                  @endforeach
                </td>
                <td>{{date('d.m.Y', strtotime($post->created_at))}}</td>
                <td>{{date('d.m.Y', strtotime($post->updated_at))}}</td>
                <td>
                  <div class="row">
                    <div class="col-md-12">
                      {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-sm btn-primary btn-block')) !!}
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop
