@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="text-center">Dashboard</h3>
            <div class="card">
            <div class="card-header"><h5>Hi <small>{{$user->name}}</small>, <small class="float-right">you have {{count($user->posts)}} post(s)</small></h5></div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th colspan="3">Posts</th>
                                    <th colspan="2" class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($user->posts as $index => $post)
                                <tr>
                                    <th scope="row">{{$index + 1}}</th>
                                    <td colspan="3"><a class="text-secondary" href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                                    <td colspan="2" class="text-right">
                                        <a href="/posts/{{$post->id}}/edit"><span class="fa fa-edit text-primary">Edit</span></a>
                                        <form class="d-inline" action="/posts/{{$post->id}}" method="POST">
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-transparent btn-sm" ><span class="fa fa-trash text-danger">Delete</span></button>
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection