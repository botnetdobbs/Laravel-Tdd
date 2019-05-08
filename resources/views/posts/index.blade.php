@extends('layouts.app')

@section('content')

@if (count($posts))
<div class="row">
<div class="col-md-8">
<h1>Posts</h1>
@foreach($posts as $post)
<div class="card mb-4">
    <img class="card-img-top" src="https://fakeimg.pl/750x300" alt="Random image">
    <div class="card-body">
        <h2 class="card-title">{{$post->title}}</h2>
        <p class="card-text">{{Str::limit($post->body)}}</p>
        <a class="btn btn-secondary" href="/post/{{$post->id}}" role="button">Read More → »</a>
    </div>
    <div class="card-footer text-muted">
        Posted on {{$post->createdAt()}} by
        <a href="#">User Unavailabe ATM</a>
    </div>
</div>

@endforeach

</div>
<div class="col-md-4 mt-4">
    <div class="card my-4">
        <h5 class="card-header">Search: Not working ATM</h5>
        <div class="card-body">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
            <button class="btn btn-secondary" type="button">Go!</button>
            </span>
        </div>
        </div>
    </div>
</div>
</div>

@else
    <p>No Posts available.</p>
@endif

@endsection