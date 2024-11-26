@extends('layouts.index')

@section('body')

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Add New Topic</h1>
            </div>
            <div class="modal-body">
                <form id="ajax-form" method="post" action="{{ route('store.topic') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control" id="title">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="summernote" rows="4"></textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
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
                    <button class="btn btn-success" type="submit">Add</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-10 offset-1 mt-2 ">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                Add Topic
            </button>
            <div class="card">
                <div class="card-header bg-info text-white text-center">
                    <h4>Topics List</h4>
                </div>
                <div class="card-body col-md-12">
                    <table class="table table-bordered" cellspacing="0" cellpadding="5">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Sequence</th>
                                <th>Programming Language</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topics as $topic)
                                <tr>
                                    <td>{{ $topic->title }}</td>
                                    <td>{{ $topic->sequence }}</td>
                                    <td>{{ $topic->language->name }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="{{ route('edit.topic', $topic->slug) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <a href="{{ route('destroy.topic', $topic->slug) }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this topic?');">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                </tr>
                            @endforeach

                        </tbody>


                    </table>
                </div>
                {{ $topics->links() }}

            </div>
        </div>


    </div>

</div>

<script type="text/javascript">

    $('#ajax-form').submit(function (e) {
        e.preventDefault();

        var url = $(this).attr("action");
        let formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                alert('topic successfully added');
                location.reload();
            },
            error: function (response) {
                $('#ajax-form').find(".print-error-msg").find("ul").html('');
                $('#ajax-form').find(".print-error-msg").css('display', 'block');
                $.each(response.responseJSON.errors, function (key, value) {
                    $('#ajax-form').find(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });
            }
        });

    });

</script>





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