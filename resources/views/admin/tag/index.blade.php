@extends('layouts.app')

@section('content')
    <div class="panel panel default">
        <div class="panel-heading">Tags</div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Tag Name</th>
                    <th>Created at</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @if($tags->count() > 0)
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{$tag->tag}}</td>
                            <td>{{$tag->created_at ? $tag->created_at->diffForHumans() : 'no date'}}</td>
                            <td>
                                <a href="{{route('tag.edit', ['id'=>$tag->id])}}" class="btn btn-xs btn-info">Edit</a>
                            </td>

                            <td>
                                <a href="{{route('tag.delete', ['id'=>$tag->id])}}" class="btn btn-xs btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">There are no Tags yet...</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection