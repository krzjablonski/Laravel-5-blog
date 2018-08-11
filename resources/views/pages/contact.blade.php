@extends('layouts.main')
@section('title', $data['title'])
@section('content')
<div class="container">
  <div class="row">
    <div class="col pt-5">
      <h1>Contact Me</h1>

      {!! Form::open(['route' => 'contact.send']) !!}
        {{ Form::label('name', 'Name:') }}
        {{ Form::text('name', null, ['class'=>'form-control mb-3']) }}

        {{ Form::label('email', 'Email:') }}
        {{ Form::email('email', null, ['class'=>'form-control mb-3']) }}

        {{Form::label('message', 'Message:')}}
        {{ Form::textarea('message', null, ['class' => 'form-control mb-3']) }}

        {{ Form::submit('Send', ['class'=>'btn btn-primary btn-block']) }}

      {!! Form::close() !!}


    </div>
  </div>
</div>
@endsection
