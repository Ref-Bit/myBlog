@extends('layouts.app')

@section('content')
    <div class="panel panel default">
        <div class="panel-heading">Trashed Posts</div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Restore</th>
                    <th>Destroy</th>
                    <th>Created at</th>
                    <th>Deleted at</th>
                </tr>
                </thead>
                <tbody>

            @if($posts->count() > 0)
                @foreach($posts as $post)
                    <tr>
                        <td><img src="{{$post->featured}}" alt="" width="90px" height="50px"></td>
                        <td>{{$post->title}}</td>

                        <td>
                            <a href="{{route('post.edit', ['id'=>$post->id])}}" class="btn btn-xs btn-info">Edit</a>
                        </td>
                        <td>
                            <a href="{{route('post.restore', ['id'=>$post->id])}}" class="btn btn-xs btn-success">Restore</a>
                        </td>

                        <td>
                            <a href="{{route('post.kill', ['id'=>$post->id])}}" class="btn btn-xs btn-danger">Destroy</a>
                        </td>

                        <td>{{$post->created_at ? $post->created_at->diffForHumans() : 'no date'}}</td>
                        <td>{{$post->deleted_at ? $post->deleted_at->diffForHumans() : 'no date'}}</td>
                    </tr>
                @endforeach
                @else
                <tr>
                    <th colspan="5" class="text-center">No Trashed Posts...</th>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection