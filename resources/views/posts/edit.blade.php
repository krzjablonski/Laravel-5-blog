@extends('layouts.main')

@section('title', 'Edit New Post')

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
@endsection

@section('content')

<div class="container mt-5">
  {!!Form::model($post, ['route'=>['posts.update', $post->id], 'method'=>'PUT', 'data-parsley-validate' => '', 'class'=>'row'])!!}
    <div class="col-md-8">
      <h1>{{$post->title}}</h1>
      {{Form::label('title', 'Title:')}}
      {{Form::text('title', null, array('class'=>'form-control mb-3 form-control-lg', 'required'=>'', 'Maxlength' => '255'))}}

      {{Form::label('category_id', 'Category:')}}
      {{Form::select('category_id', $categories, null, array('class'=>'form-control mb-3', 'required'=>''))}}

      {{Form::Label('tags', 'Tags:')}}
      {{Form::select('tags', $tags, null, array('class'=>'form-control mb-3 select2', 'required'=>'', 'multiple'=>'multiple'))}}

      {{Form::label('slug', 'Slug:')}}
      {{Form::text('slug', null, array('class'=>'form-control mb-3', 'required'=>'', 'Maxlength' => '255'))}}

      {{Form::label('body', 'Post body:')}}
      {{Form::textarea('body', null, array('class'=>'form-control', 'required'=>''))}}
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="row card-body align-items-center">
          <div class="col-sm-12">
            <dl>
              <dt>Slug:</dt>
              <dd><a href="{{url($post->slug)}}"/>{{url($post->slug)}}</a></dd>
            </dl>
          </div>
          <div class="col-sm-6">
            <dl>
              <dt>Created At:</dt>
              <dd>{{date('d.m.Y', strtotime($post->created_at))}}</dd>
            </dl>
            {{Form::submit('Update', ['class'=>'btn btn-success btn-lg btn-block'])}}
          </div>
          <div class="col-sm-6">
            <dl>
              <dt>Last updated:</dt>
              <dd>{{date('d.m.Y @ H:i', strtotime($post->updated_at))}}</dd>
            </dl>
            {!! Html::linkRoute('posts.index', 'Cancel', array($post->id), array('class'=>'btn btn-link text-danger btn-block')) !!}
          </div>
        </div>
      </div>
    </div>
  {!!Form::close()!!}
</div>

@endsection
