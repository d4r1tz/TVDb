@extends('layout')

@section('content')
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title fw-bolder mb-3">Update Episode</h5>
            <form method="post" action="{{ route('episode.update', $data->episode_id) }}">
                @csrf
                <div class="mb-3">
                    <label for="episode_id" class="form-label">ID</label>
                    <input type="number" class="form-control" id="episode_id" name="episode_id" value="{{ $data->episode_id}}">
                </div>

                <div class="mb-3">
                    <label for="episode_title" class="form-label">Episode Title</label>
                    <input type="text" class="form-control" id="episode_title" name="episode_title" value="{{ $data->episode_title}}">
                </div>
 
                <div class="mb-3">
                    <label for="episode_rel_date" class="form-label">Release Date</label>
                    <input type="Date" class="form-control" id="episode_rel_date" name="episode_rel_date" value="{{ $data->episode_rel_date }}">
                </div>
 
                <div class="mb-3">
                    <label for="writer" class="form-label">Writer</label>
                    <input type="text" class="form-control" id="writer" name="writer" value="{{ $data->writer }}">
                </div>

                <div class="mb-3">
                    <label for="director" class="form-label">Director</label>
                    <input type="text" class="form-control" id="director" name="director" value="{{ $data->director }}">
                </div>

                <div class="mb-3">
                    <label for="season_id" class="form-label">Season ID (Refer to the Seasons Data)</label>
                    <input type="number" class="form-control" id="season_id" name="season_id" value="{{ $data->season_id }}">
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Update" />
                </div>
            </form>
        </div>
    </div>
@stop