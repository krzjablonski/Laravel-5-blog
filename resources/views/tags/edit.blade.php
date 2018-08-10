@extends('layouts.main')
@section('title', ' Edit Tag')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        {!! Form::model($tag, ['route'=>['tags.update', $tag->id], 'method'=>'PUT']) !!}
          {{ Form::label('tag_name') }}
          {{ Form::text('tag_name', null, ['class'=>'form-control']) }}
          {{ Form::submit('Save', ['class'=>'btn btn-success btn-block mt-5']) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
