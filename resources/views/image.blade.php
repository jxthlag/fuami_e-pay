@extends('layouts.master')

@section('header', 'Public Storage Viewer')

@section('content')
<div class="container">
    <h2 class="mb-4">Images in Storage</h2>
    @if($files && count($files))
        <div class="row">
            @foreach($files as $file)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="{{ asset($file) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Image">
                        <div class="card-body">
                            <p class="text-muted text-truncate mb-0">{{ basename($file) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No images found in <code>storage/app/public</code>.</p>
    @endif
</div>
@endsection
