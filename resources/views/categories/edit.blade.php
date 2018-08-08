@extends('layouts.main')
@section('title', ' Edit Category')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        {!! Form::model($category, ['route'=>['categories.update', $category->id], 'method'=>'PUT']) !!}
          {{ Form::label('category_name') }}
          {{ Form::text('category_name', null, ['class'=>'form-control']) }}
          {{ Form::submit('Save', ['class'=>'btn btn-success btn-block mt-5']) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
