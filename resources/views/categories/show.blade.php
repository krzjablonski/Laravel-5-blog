@extends('layouts.main')
@section('title', ' Single Category')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h1>{{$category->category_name}}</h1>
        {{ Html::linkRoute('categories.edit', 'Edit', [$category->id], ['class'=>'btn btn-block btn-primary']) }}
      </div>
    </div>
  </div>
@stop
