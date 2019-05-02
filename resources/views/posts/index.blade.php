<h1>Posts</h1>
@foreach($posts as $post)
    <div>
        {{$post->title}}
        <hr>
        <br>
        {{Str::limit($post->body)}}
        <hr>
        <br>
        {{$post->createdAt()}}
    </div>
@endforeach