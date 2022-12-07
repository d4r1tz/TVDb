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
        <h5 class="card-title fw-bolder mb-3">Add New Season</h5>
        <form method="post" action="{{ route('seasons.store') }}">
            @csrf
            <div class="mb-3">
                <label for="season_id" class="form-label">ID</label>
                <input type="text" class="form-control" id="season_id" name="season_id">
            </div>
            
            <div class="mb-3">
                <label for="season_num" class="form-label">Season Number</label>
                <input type="number" class="form-control" id="season_num" name="season_num">
            </div>

            <div class="mb-3">
                <label for="season_rel_date" class="form-label">Release Date</label>
                <input type="date" class="form-control" id="season_rel_date" name="season_rel_date">
            </div>

            <div class="mb-3">
                <label for="serie_id" class="form-label">Serie ID (Refer to Series Table)</label>
                <input type="number" class="form-control" id="serie_id" name="serie_id">
            </div>

            <div class="text-center">
                <input type="submit" class="btn btn-primary" value="Add" />
            </div>
        </form>
    </div>
</div>
@stop