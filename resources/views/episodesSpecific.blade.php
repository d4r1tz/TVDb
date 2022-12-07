@extends('layout')

@section('content')

    <h4 class="mt-5">EPISODES</h4>
    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>Episode Title</th>
                <th>Release Date</th>
                <th>Writer</th>
                <th>Director</th>
            </tr>
        </thead>
 
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->episode_title }}</td>
                    <td>{{ $data->episode_rel_date }}</td>
                    <td>{{ $data->writer }}</td>
                    <td>{{ $data->director }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop