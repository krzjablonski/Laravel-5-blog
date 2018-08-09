@extends('layouts.main')
@section('title', ' All Categories')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8">
        <table class="table table-striped">
          <thead>
            <th>Id</th>
            <th>Category Name</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th></th>
          </thead>
            <tbody>
              @foreach($categories as $category)
                <tr>
                  <th>{{$category->id}}</th>
                  <td>{{$category->category_name}}</td>
                  <td>{{$category->created_at}}</td>
                  <td>{{$category->updated_at}}</td>
                  <td>
                    {{ Html::linkRoute('categories.edit', 'Edit', [$category->id], ['class'=>'btn btn-sm btn-primary']) }}
                    {!! Form::open(['route'=>['categories.destroy', $category->id], 'method'=>'DELETE']) !!}
                      {{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger']) }}
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <div class="card p-3">
          <h2>Add New Category</h2>
          {!! Form::open(['route'=>'categories.store']) !!}
            {{ Form::label('category_name') }}
            {{ Form::text('category_name', null, ['class'=>'form-control']) }}
            {{ Form::submit('Save', ['class'=>'btn btn-success btn-block mt-3']) }}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop
