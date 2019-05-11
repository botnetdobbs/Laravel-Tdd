@extends('layouts.app')

@section('content')

<div>
    <div>
        <h2 class="font-weight-bold">{{$post->title}}</h2>
        <span style="text-secondary">Created by {{$post->author['name']}} on {{$post->createdAt()}}</span><small></small>
    </div>
    <div class="col-md-8 offset-md-1 mt-4 text">
        {{$post->body}}
    </div>
<br><br>
@if (count($post->comments))
<!--Comments-->
    <div class="col-md-6 offset-md-1">
        <h3 class="float-left">Comments</h3>
        <h3 class="float-right">{{count($post->comments)}}</h3>
        <br><br>
        @foreach ($post->comments as $comment)
        <div class="">
            <p style="text-secondary">{{$comment['author']}} <small>{{$comment->createdAt()}}</small></p>
            <p>{{$comment->body}}</p>
        </div>
        @endforeach
    </div>
<!--Comments-->
@endif
<br><br>
<!--Reply-->
@if (auth()->user())
<div class="col-md-6 offset-md-1 mt-4">
    <div class="font-weight-bold">Leave a reply</div>
    <form action="/posts/{{$post->id}}/comments" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <textarea class="form-control" name="body" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Comment</button>
    </form>
</div>
@endif
<!--Reply-->
</div>

@endsection