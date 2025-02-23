@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Upload Your Image</h2>
    <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <button type="submit" name="button_type" value="image1" class="btn btn-primary">Image 1</button>
        <button type="submit" name="button_type" value="image2" class="btn btn-secondary">Image 2</button>
        <input type="file" name="image" class="form-control mt-3">
    </form>
</div>
@endsection
