@extends('layouts.app')

@section('content')
    <div class="panel panel default">
        <div class="panel-heading">Published Posts</div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Edit</th>
                    <th>Trash</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                </thead>
                <tbody>
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                    <tr>
                        <td><img src="{{$post->featured}}" alt="" width="90px" height="50px"></td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->category->name}}</td>

                        <td>
                            <a href="{{route('post.edit', ['id'=>$post->id])}}" class="btn btn-xs btn-info">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('post.delete', ['id'=>$post->id])}}" class="btn btn-xs btn-danger">Trash</a>
                        </td>
                        <td>{{$post->created_at ? $post->created_at->diffForHumans() : 'no date'}}</td>
                        <td>{{$post->updated_at ? $post->updated_at->diffForHumans() : 'no date'}}</td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">There are no Posts...</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection