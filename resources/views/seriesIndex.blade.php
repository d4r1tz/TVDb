@extends('layout')

@section('content')

    <h4 class="mt-5">SERIES DATA</h4>
    <form action = "{{route('seriesSearch')}}" class="form-inline" method="GET">
        <input type = "search" name="search" class="form-control float-right" placeholder="Search Title">
            <div class="input-group-append">
                <button type = "submit" class = "btn btn-default">
                    <i class = "fas fa-search"></i>
                </button>
            </div>
    </form>
    <a href="{{ route('seriesAdd') }}" type="button" class="btn btn-success rounded-3">ADD DATA</a>
    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Release Year</th>
                <th>Creator</th>
                <th>Genre</th>
                <th>Action</th>
            </tr>
        </thead>
 
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->serie_id }}</td>
                    <td>{{ $data->serie_title }}</td>
                    <td>{{ $data->ser_rel_year }}</td>
                    <td>{{ $data->creator }}</td>
                    <td>{{ $data->genre }}</td>
                    <td>
                        <a href="{{ route('seriesEdit', $data->serie_id) }}" type="button" class="btn btn-warning rounded-3">Update</a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->serie_id }}">Delete</button>
                        <a class="btn btn-info" href="{{ route('seriesSoftDel', $data->serie_id) }}">Hide</button>
                        <a></a>
                        <a class="btn btn-primary" href="{{ route('seasonsSpecific', $data->serie_id) }}">Seasons</a>
                        
                        
                        <div class="modal fade" id="hapusModal{{ $data->serie_id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">WARNING</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('series.delete', $data->serie_id) }}">
                                        @csrf
                                        <div class="modal-body">Are You Sure</div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Yes</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('seasonsOverall') }}" type="button" class="btn btn-info rounded-3">MANAGE SEASONS</a>
    <a href="{{ route('episodesOverall') }}" type="button" class="btn btn-info rounded-3">MANAGE EPISODES</a>
    <a class="btn btn-danger" href="{{ route('logout') }}" >LOGOUT</a>
@stop