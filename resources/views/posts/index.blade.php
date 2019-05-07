<h1>Posts</h1>
@if (count($posts))
@foreach($posts as $post)
<div>
    <h2><a href="/post/{{$post->id}}">{{$post->title}}</a></h2>
    <hr>
    <br>
    {{Str::limit($post->body)}}
    <hr>
    <br>
    {{$post->createdAt()}}
</div>
@endforeach
@else
    <p>No Posts available.</p>
@endif