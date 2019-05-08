@extends('layouts.app')

@section('content')

<h1>Create Post</h1>
<form method="POST" action="/posts">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
    </div>
    <div class="form-group">
      <label for="body">Description</label>
      <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
    </div>
    {{ csrf_field() }}
    <button type="submit" class="btn btn-primary">Save Post</button>
</form>

@endsection