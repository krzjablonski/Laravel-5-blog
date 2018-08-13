@extends('layouts.main')
@section('title', ' All Posts')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-10">
        <h1>All Posts</h1>
      </div>
      <div class="col-md-2">
        {!! Html::linkRoute('posts.create', 'Add New Post', array(), array('class'=>'btn btn-primary')) !!}
      </div>
    </div>
    <div class="row">
      <div class="col">
        <table class="table table-striped">
          <thead>
            <th>Id</th>
            <th>Title</th>
            <th>Category</th>
            <th>Comments</th>
            <th>Created at</th>
            <th>Last update</th>
            <th></th>
          </thead>
          <tbody>
            @foreach($posts as $post)
              <tr>
                <th>{{$post->id}}</th>
                <td>{!! Html::linkRoute('posts.show', $post->title, array($post->id), array()) !!}</td>
                <td>{{$post->category->category_name}}</td>
                <td>{{$post->comments()->where('approved', true)->count()}} / {{$post->comments()->count()}}</td>
                <td>{{date('d.m.Y', strtotime($post->created_at))}}</td>
                <td>{{date('d.m.Y', strtotime($post->updated_at))}}</td>
                <td>
                  <div class="row">
                    <div class="col-md-12">
                      {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-sm btn-primary btn-block')) !!}
                    </div>
                    <div class="col-md-12 pt-1">
                      {!! Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'DELETE']) !!}
                        {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-sm btn-block']) }}
                      {!! Form::close() !!}
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <div>
          {!! $posts->links(); !!}
        </div>
      </div>
    </div>
  </div>
@stop
