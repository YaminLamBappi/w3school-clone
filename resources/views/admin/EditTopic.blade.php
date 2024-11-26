@extends('layouts.index')

@section('body')

<div class="container mt-1">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Edit Topic</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('update.topic', ['slug' => $topic->slug]) }}">
                        @csrf

                        <!-- Title input -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input value="{{ $topic->title }}" name="title" type="text" class="form-control" id="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description input -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="summernote"
                                rows="4">{!! $topic->description !!}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sequence input -->
                        <div class="form-group">
                            <label for="sequence">Sequence</label>
                            <input value="{{ $topic->sequence }}" name="sequence" type="number" class="form-control"
                                id="sequence">
                            @error('sequence')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Language selection -->
                        <div class="form-group">
                            <label for="language_slug">Programming Language</label>
                            <select name="language_slug" class="form-control" id="language_slug">
                                @foreach ($languages as $language)
                                    <option value="{{ $language->slug }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                            @error('language_slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']],
            ]
        });
    });
</script>
@endsection
@endsection