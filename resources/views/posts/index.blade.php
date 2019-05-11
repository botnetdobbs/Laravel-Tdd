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
        <a class="btn btn-secondary float-left" href="/post/{{$post->id}}" role="button">Read More → »</a>
        @if (auth()->user()->id === (int)$post->user_id)
        <div class="float-right">
            <a class="btn btn-primary" href="/post/{{$post->id}}/edit" role="button">Edit <span class="fa fa-edit"></span></a>
            <form class="float-right ml-3" action="/post/{{$post->id}}" method="POST">
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger">Delete <span class="fa fa-trash"></span></button>
            {{ csrf_field() }}
            </form>
        </div>
        @endif
    </div>
    <div class="card-footer text-muted">
        Posted on {{$post->createdAt()}} by
        <a href="/user/{{$post->author['name']}}">{{$post->author['name']}}</a>
    </div>
</div>
@endforeach
<div class="d-flex justify-content-center">
    {{ $posts->links() }}
</div>

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