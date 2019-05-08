<h1>Edit Post</h1>
<form method="POST" action="/post/{{$post->id}}">
  {{ method_field('PUT') }}
    <div class="form-group">
      <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
    </div>
    <div class="form-group">
      <label for="body">Description</label>
      <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{$post->body}}</textarea>
    </div>
    {{ csrf_field() }}
    <button type="submit" class="btn btn-primary">Save Post</button>
</form>