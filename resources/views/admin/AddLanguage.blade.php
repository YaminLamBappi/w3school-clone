@extends('layouts.index')

@section('body')


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Add Language</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('store.language') }}">
                        @csrf
                        <input name="name" type="text">
                        <br>

                        <button class="btn btn-success" type="submit">Add</button>
                    </form>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>

@endsection