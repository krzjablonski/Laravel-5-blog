@extends('layouts.main')
@section('title', ' all posts')
@section ('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8">
        <h1>Blog</h1>
        @foreach($posts as $post)
          <div class="post border-bottom mt-5 pb-3">
            <p class="text-muted mb-0">{{date('d.m.Y', strtotime($post->created_at))}}</p>
            <h2>{{$post->title}}</h2>
            <p class="post-excerpt">{{$post->body}}</p>
            {!! Html::linkRoute('blog.single', 'Read more', [$post->slug], ['class'=>'btn btn-primary btn-sm']) !!}
          </div>
        @endforeach
        {!! $posts->links(); !!}
      </div>
      <!-- Sidebar collumn -->
      <div class="col-md-3 offset-md-1">
        <h2>Sidebar</h2>
      </div>
    </div>
  </div>
@stop
