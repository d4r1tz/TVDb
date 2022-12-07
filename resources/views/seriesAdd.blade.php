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
        <h5 class="card-title fw-bolder mb-3">Add New Series</h5>
        <form method="post" action="{{ route('series.store') }}">
            @csrf
            <div class="mb-3">
                <label for="serie_id" class="form-label">ID</label>
                <input type="text" class="form-control" id="serie_id" name="serie_id">
            </div>
            
            <div class="mb-3">
                <label for="serie_title" class="form-label">Title</label>
                <input type="text" class="form-control" id="serie_title" name="serie_title">
            </div>

            <div class="mb-3">
                <label for="ser_rel_year" class="form-label">Release Year</label>
                <input type="number" class="form-control" id="ser_rel_year" name="ser_rel_year">
            </div>

            <div class="mb-3">
                <label for="creator" class="form-label">Creator</label>
                <input type="text" class="form-control" id="creator" name="creator">
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Genre</label>
                <input type="text" class="form-control" id="genre" name="genre">
            </div>

            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Add" />
            </div>
        </form>
    </div>
</div>
@stop