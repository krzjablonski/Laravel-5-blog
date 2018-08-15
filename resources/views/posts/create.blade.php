@extends('layouts.main')

@section('title', 'Create New Post')

@section('stylesheet')
  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('css/select2.min.css') !!}
@endsection

@section('script')
  {!! Html::script('js/parsley.min.js') !!}
  {!! Html::script('js/select2.full.min.js') !!}
  <script type="text/javascript">
  $('.select2').select2({
    placeholder: 'Select an option'
  });
  </script>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
  tinymce.init({
    selector:'textarea',
    plugins: "lists code table hr link",
  });
</script>
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

            {{Form::Label('tags', 'Tags:')}}
            {{Form::select('tags[]', $tags, null, array('id'=>'tags', 'class'=>'form-control select2', 'required'=>'', 'multiple'=>'multiple'))}}

            {{Form::label('body', 'Post body:', ['class' => 'mt-3'])}}
            {{Form::textarea('body', null, array('class'=>'form-control'))}}

            {{Form::submit('Save Post', array('id' => 'submit', 'class'=>'btn btn-success btn-lg btn-block mt-3'))}}

          {!! Form::close() !!}
      </div>
    </div>
  </div>

@endsection
