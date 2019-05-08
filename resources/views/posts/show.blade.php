@extends('layouts.app')

@section('content')

<div>
    <div>
        <h2 class="font-weight-bold">{{$post->title}}</h2>
        <span style="text-secondary">Created by User_still_unknown on {{$post->createdAt()}}</span><small></small>
    </div>
    <div class="col-md-8 offset-md-1 mt-4">
        {{$post->body}}
    </div>
</div>

@endsection