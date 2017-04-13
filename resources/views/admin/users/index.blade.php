@extends('layouts.admin');

@section('content')
    <h1>Users</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        </thead>
        <tbody>
            @if($users)
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td><img height="46" src="{{$user->photo ? $user->photo->path : 'No User Photo'}}" alt=""><img src="" alt=""></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->is_active === 1 ? 'Active':'Inactive'}}</td>
                        <td>
                            {{$user->created_at}}<br>
                            <small>({{$user->created_at->diffForHumans()}})</small>
                        </td>
                        <td>
                            {{$user->updated_at}}<br>
                            <small>({{$user->created_at->diffForHumans()}})</small>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@stop