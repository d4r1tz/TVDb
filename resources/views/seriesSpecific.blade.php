@extends('layout')

@section('content')

    <h4 class="mt-5">SERIES</h4>
    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>Title</th>
                <th>Release Year</th>
                <th>Creator</th>
                <th>Genre</th>
                <th></th>
            </tr>
        </thead>
 
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->serie_title }}</td>
                    <td>{{ $data->ser_rel_year }}</td>
                    <td>{{ $data->creator }}</td>
                    <td>{{ $data->genre }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('seasonsSpecific', $data->serie_id) }}">Seasons</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-info" href="{{ route('seriesIndex') }}" >Back</a>
@stop