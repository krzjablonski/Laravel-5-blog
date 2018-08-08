@extends('layouts.main')
@section('title', ' Home page')
@section('content')
<!-- Jumbotron -->
<div class="container-fluid">
  <div class="row">
    <div class=" col jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Wecome to this blog!</h1>
        <p class="lead">Thanks for visiting my blog! Hope you will like it.</p>
        <a href="#" class="btn btn-primary btn-lg">Popular posts</a>
      </div>
    </div>
  </div>
</div>
<!-- End of Jumbotron -->

<!-- Main content -->
<div class="container">
  <div class="row">
    <!-- Posts collumn -->
    <div class="col-md-8">
      @foreach($posts as $post)
        <div class="post border-bottom mt-5 pb-3">
          <p class="text-muted mb-0">{{date('d.m.Y', strtotime($post->created_at))}}</p>
          <h2>{{$post->title}}</h2>
          <p class="post-excerpt">{{$post->body}}</p>
          {{ Html::linkRoute('blog.single', 'Read more', [$post->slug], ['class'=>'btn btn-primary btn-sm']) }}
        </div>
      @endforeach
    </div>
    <!-- Sidebar collumn -->
    <div class="col-md-3 offset-md-1">
      <h2>Sidebar</h2>
    </div>
  </div>
</div>
@endsection
