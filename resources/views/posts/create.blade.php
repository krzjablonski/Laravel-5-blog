@extends('layouts.main')

@section('title', 'Create New Post')

@section('stylesheet')
  {!! Html::style('css/parsley.css') !!}
@endsection

@section('script')
  {!! Html::script('js/parsley.min.js') !!}
@endsection

@section('content')

  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h1>Create New Post</h1>
        <div class="form-group">
          {!! Form::open(['route' => 'posts.store', 'data-parsley-validate' => '']) !!}

            {{Form::label('title', 'Title:')}}
            {{Form::text('title', null, array('class'=>'form-control mb-3', 'required'=>'', 'Maxlength' => '255'))}}

            {{Form::label('category_id', 'Category:')}}
            {{Form::select('category_id', $categories, null, array('class'=>'form-control mb-3', 'required'=>''))}}

            {{Form::label('slug', 'Slug:')}}
            {{Form::text('slug', null, array('class'=>'form-control mb-3', 'required'=>'', 'Maxlength' => '255'))}}

            {{Form::label('body', 'Post body:')}}
            {{Form::textarea('body', null, array('class'=>'form-control', 'required'=>''))}}

            {{Form::submit('Save Post', array('class'=>'btn btn-success btn-lg btn-block mt-3'))}}

          {!! Form::close() !!}
      </div>
    </div>
  </div>

@endsection
