@extends('layouts.main')
@section('title', ' View Post')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8">
        <p>{{$post->category->category_name}}</p>
        <h1>{{$post->title}}</h1>
        <p>{{$post->body}}</p>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="row card-body">
            <div class="col-sm-12">
              <dl>
                <dt>Slug:</dt>
                <dd>{!! Html::linkRoute('blog.single', url($post->slug), array($post->slug)) !!}</dd>
              </dl>
            </div>
            <div class="col-sm-6">
              <dl>
                <dt>Created At:</dt>
                <dd>{{date('d.m.Y', strtotime($post->created_at))}}</dd>
              </dl>
              {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class'=>'btn btn-primary btn-block')) !!}
            </div>
            <div class="col-sm-6">
              <dl>
                <dt>Last updated:</dt>
                <dd>{{date('d.m.Y @ H:i', strtotime($post->updated_at))}}</dd>
              </dl>
              {!! Form::open(['route'=>['posts.destroy', $post->id], 'method'=>'DELETE']) !!}
                {{ Form::submit('Delete', ['class'=>'btn btn-danger btn-block ']) }}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
