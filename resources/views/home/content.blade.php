@extends('home.home')


@section('body')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0 text-center">{{ $content->title }}</h2>
        </div>
        <div class="card-body">
            <p class="lead text-justify">
                {!! $content->description !!}
            </p>
        </div>
    </div>
</div>
@endsection