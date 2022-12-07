@extends('layout')

@section('content')

    <h4 class="mt-5">EPISODES DATA</h4>
    <a href="{{ route('episodesAdd') }}" type="button" class="btn btn-success rounded-3">ADD EPISODE</a>
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
                <th>Release Date</th>
                <th>Season</th>
                <th>Series</th>
                <th>ACTION</th>
            </tr>
        </thead>
 
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $data->episode_id }}</td>
                    <td>{{ $data->episode_title }}</td>
                    <td>{{ $data->episode_rel_date }}</td>
                    <td>{{ $data->season_num }}</td>
                    <td>{{ $data->serie_title }}</td>
                    <td>
                        <a href="{{ route('episodesEdit', $data->episode_id) }}" type="button" class="btn btn-warning rounded-3">Update</a>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $data->episode_id }}">Delete</button>
                        <a class="btn btn-info" href="{{ route('episodeSoftDel', $data->episode_id) }}">Hide</button>
                        <div class="modal fade" id="hapusModal{{ $data->episode_id }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusModalLabel">WARNING</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('episode.delete', $data->episode_id) }}">
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
    <a href="{{ route('seasonsOverall') }}" type="button" class="btn btn-info rounded-3">MANAGE SEASONS</a>
    <a href="{{ route('logout') }}" type="button" class="btn btn-danger">LOGOUT</a>
    <p></p>
@stop