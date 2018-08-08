@extends('layouts.main')
@section('title', $data['title'])
@section('content')
<div class="container">
  <div class="row">
    <div class="col pt-5">
      <h1>Contact Me</h1>
      <form class="mt-5" action="index.html" method="post">
        <div class="row">
          <div class="form-group col">
            <label for="name">Your Name</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group col">
            <label for="email">Your Email</label>
            <input type="text" name="email" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" name="subject" class="form-control">
        </div>
        <div class="form-group">
          <label for="message">Your Message</label>
          <textarea name="message" rows="8" cols="80" class="form-control"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection
