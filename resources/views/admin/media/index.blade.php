@extends('layouts.admin')

@section('content')
    <h1>Media</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Images</th>
                <th class="text-center">Created At</th>
                <th class="text-center">Updated At</th>
            </tr>
        </thead>

        <tbody>
            @if($images)
                @foreach($images as $image)
                    <tr>
                        <td>{{$image->id}}</td>
                        <td><img height="100" src="{{$image->path}}" alt=""></td>
                        <td class="text-center">
                            {{$image->created_at}}<br>
                            <small>({{$image->created_at->diffForHumans()}})</small>
                        </td>
                        <td class="text-center">
                            {{$image->updated_at}}<br>
                            <small>({{$image->updated_at->diffForHumans()}})</small>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@stop