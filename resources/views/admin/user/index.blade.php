@extends('layouts.app')

@section('content')
    <div class="panel panel default">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Delete</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                </tr>
                </thead>
                <tbody>
                @if($users->count() > 0)
                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{asset($user->profile->avatar)}}" alt="" width="50px" height="50px" style="border-radius:50%"></td>
                            <td>{{$user->name}}</td>
                            <td>
                                @if($user->admin)
                                    <a href="{{route('user.not.admin', ['id'=>$user->id])}}" class="btn btn-xs btn-danger">Make Subscriber</a>
                                @else
                                    <a href="{{route('user.admin', ['id'=>$user->id])}}" class="btn btn-xs btn-primary">Make Admin</a>
                                    @endif
                            </td>
                            <td>
                                @if(Auth::id() !== $user->id)
                                <a href="{{route('user.delete', ['id'=>$user->id])}}" class="btn btn-xs btn-danger">Delete Profile</a>
                                    @endif
                            </td>
                            <td>{{$user->created_at ? $user->created_at->diffForHumans() : 'no date'}}</td>
                            <td>{{$user->updated_at ? $user->updated_at->diffForHumans() : 'no date'}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th colspan="5" class="text-center">There are no Users...</th>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection