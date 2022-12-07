@extends('layout')

@section('content')

    <h4 class="mt-5">SEASONS</h4>
    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>Season</th>
                <th>Release Date</th>
                <th>Title</th>
                <th></th>
            </tr>
        </thead>
 
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->season_num }}</td>
                    <td>{{ $data->season_rel_date }}</td>
                    <td>{{ $data->serie_title }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('episodesSpecific', $data->season_id) }}">EPISODES</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop