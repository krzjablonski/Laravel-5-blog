@extends('layouts.main')
@section('title', ' '.htmlspecialchars($post->title))
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <img class="img-fluid mb-3" src="{{asset('images/' . $post->featured_image)}}" alt="">
        <p>Category: <strong>{{$post->category->category_name}}</strong></p>
        <h1>{{$post->title}}</h1>
        <p>{!!$post->body!!}</p>
        <hr>
        <p><strong>Tags:</strong>
          @foreach($post->tags as $key => $tag)
            <span class="badge badge-secondary">{{$tag->tag_name}}</span>
          @endforeach
        </p>
        <hr>
      </div>
    </div>
  </div>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h3 class="mb-4">Comments <span class="badge badge-primary">{{$post->comments()->where('approved', true)->count()}}</span></h3>
        @foreach($post->comments as $comment)
          @if($comment->approved == 1)
            <h6>{{$comment->name}} <small>on {{$comment->created_at}}</small></h6>
            <p>{{$comment->comment}}</p>
            <hr>
          @endif
        @endforeach
          {!! Form::open(['route' => ['comments.store', $post->id], 'class' => 'row mt-4']) !!}
          <div class="col-md-12">
            <h5 class='mb-3 mt-2'>Add New Comment</h5>
          </div>
          <div class="col-md-6">
            {{ Form::label('name', 'Your Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control mb-1']) }}
          </div>
          <div class="col-md-6">
            {{ Form::label('email', 'Your Email:') }}
            {{ Form::email('email', null, ['class' => 'form-control mb-1']) }}
          </div>
          <div class="col-md-12">
            {{ Form::label('comment', 'Comment:') }}
            {{ Form::textarea('comment', null, ['class' => 'form-control mb-2', 'rows' => '5']) }}

            {{ Form::submit('Send Comment', ['class' => 'btn btn-primary btn-block']) }}
          </div>
          {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
