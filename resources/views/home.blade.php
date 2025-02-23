@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('home') }}" method="GET">
        <input type="text" name="search" placeholder="Search by name or email">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('upload') }}" class="btn btn-primary">Upload Image</a>

    <div class="row">
        @foreach($images as $image)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Uploaded Image">
                <div class="card-body">
                    <h5 class="card-title">Uploaded by: {{ $image->user->name }} ({{ $image->user->email }})</h5>
                    <p class="card-text">Button: {{ $image->button_type }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
