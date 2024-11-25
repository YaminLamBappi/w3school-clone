@extends('layouts.index')

@section('body')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h1>Add Topic</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('store.topic') }}">
                        @csrf

                        <!-- Title input -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" type="text" class="form-control" id="title" required>
                        </div>

                        <!-- Description input -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="summernote" rows="4"
                                required></textarea>
                        </div>

                        <!-- Language selection -->
                        <div class="form-group">
                            <label for="language_id">Programming Language</label>
                            <select name="language_id" class="form-control" id="language_id" required>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-success" type="submit">Add</button>
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