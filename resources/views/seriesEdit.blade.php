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
            <h5 class="card-title fw-bolder mb-3">Update Series</h5>
            <form method="post" action="{{ route('series.update', $data->serie_id) }}">
                @csrf
                <div class="mb-3">
                    <label for="serie_id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="serie_id" name="serie_id" value="{{ $data->serie_id}}">
                </div>

                <div class="mb-3">
                    <label for="serie_title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="serie_title" name="serie_title" value="{{ $data->serie_title}}">
                </div>
 
                <div class="mb-3">
                    <label for="ser_rel_year" class="form-label">Release Year</label>
                    <input type="text" class="form-control" id="ser_rel_year" name="ser_rel_year" value="{{ $data->ser_rel_year }}">
                </div>
 
                <div class="mb-3">
                    <label for="creator" class="form-label">Creator</label>
                    <input type="text" class="form-control" id="creator" name="creator" value="{{ $data->creator }}">
                </div>
 
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre" value="{{ $data->genre }}">
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Update" />
                </div>
            </form>
        </div>
    </div>
@stop