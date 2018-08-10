@extends('layouts.main')
@section('title', ' All Tags')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-10">
        <table class="table table-striped">
          <thead>
            <th>Id</th>
            <th>Tag Name</th>
            <th>Number of posts</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th></th>
          </thead>
            <tbody>
              @foreach($tags as $tag)
                <tr>
                  <th>{{$tag->id}}</th>
                  <td>{!! Html::linkRoute('tags.show', $tag->tag_name, [$tag->id], []) !!}</td>
                  <td>{{$tag->posts()->count()}}</td>
                  <td>{{$tag->created_at}}</td>
                  <td>{{$tag->updated_at}}</td>
                  <td>
                    {{ Html::linkRoute('tags.edit', 'Edit', [$tag->id], ['class'=>'btn btn-sm btn-primary']) }}
                    {!! Form::open(['route'=>['tags.destroy', $tag->id], 'method'=>'DELETE']) !!}
                      {{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger']) }}
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
      <div class="col-md-2">
        <div class="card p-3">
          <h4>Add New Tag</h4>
          {!! Form::open(['route'=>'tags.store']) !!}
            {{ Form::label('tag_name') }}
            {{ Form::text('tag_name', null, ['class'=>'form-control']) }}
            {{ Form::submit('Save', ['class'=>'btn btn-success btn-block mt-3']) }}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop
