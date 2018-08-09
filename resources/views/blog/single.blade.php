@extends('layouts.main')
@section('title', ' '.$post->title)
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <p>Category: <strong>{{$post->category->category_name}}</strong></p>
        <h1>{{$post->title}}</h1>
        <p>{{$post->body}}</p>
      </div>
    </div>
  </div>
@stop
