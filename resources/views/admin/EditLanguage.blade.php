@extends('layouts.index')

@section('body')


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Update Language</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('update.language', ['id' => $language->id]) }}">
                        @csrf
                        <input value="{{ $language->name }}" name="name" type="text">
                        <br>

                        <button class="btn btn-success" type="submit">update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection