@extends('layout')

@section('content')

    <h4 class="mt-5">SEASONS DATA</h4>
    <a href="{{ route('seasonsAdd') }}" type="button" class="btn btn-success rounded-3">ADD SEASON</a>
    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Season</th>
                <th>Release Date</th>
                <th>Series Title</th>
                <th>Action</th>
            </tr>
        </thead>
 
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->season_id }}</td>
                    <td>{{ $data->season_num }}</td>
                    <td>{{ $data->season_rel_date }}</td>
                    <td>{{ $data->serie_title }}</td>
                    <td>
                        <a href="{{ route('seasonsEdit', $data->season_id) }}" type="button" class="btn btn-warning rounded-3">Update</a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->season_id }}">Delete</button>
                        <a class="btn btn-info" href="{{ route('seasonSoftDel', $data->season_id) }}">Hide</button>
                        <div class="modal fade" id="hapusModal{{ $data->season_id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">WARNING</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('season.delete', $data->season_id) }}">
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
    <a href="{{ route('seriesIndex') }}" type="button" class="btn btn-info rounded-3">MANAGE SERIES</a>
    <a href="{{ route('episodesOverall') }}" type="button" class="btn btn-info rounded-3">MANAGE EPISODES</a>
    <a href="{{ route('logout') }}" type="button" class="btn btn-danger">LOGOUT</a>
    <p></p>
@stop