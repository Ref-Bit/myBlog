@extends('layouts.app')

@section('content')
    <div class="panel panel default">
        <div class="panel-heading">Categories</div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Created at</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>

                @if($categories->count() > 0)
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->created_at ? $category->created_at->diffForHumans() : 'no date'}}</td>
                        <td>
                            <a href="{{route('category.edit', ['id'=>$category->id])}}" class="btn btn-xs btn-info">Edit</a>
                        </td>

                        <td>
                            <a href="{{route('category.delete', ['id'=>$category->id])}}" class="btn btn-xs btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">There are no Categories...</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection