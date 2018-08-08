@extends('layouts.main')
@section('title', ' Add New Category')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        {!! Form::open(['route'=>'categories.store']) !!}
          {{ Form::label('category_name') }}
          {{ Form::text('category_name', null, ['class'=>'form-control']) }}
          {{ Form::submit('Save', ['class'=>'btn btn-success btn-block mt-5']) }}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@stop
