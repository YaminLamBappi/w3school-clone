@extends('layouts.index')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('body')

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1>Add New Topic</h1>
            </div>
            <div class="modal-body">
                <form id="ajax-form" method="post">
                    @csrf
                    <div class=" form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control" id="title">

                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="4"></textarea>

                    </div>
                    <div class="form-group">
                        <label for="language_slug">Programming Language</label>
                        <select name="language_slug" class="form-control" id="language_slug">
                            @foreach ($languages as $language)
                                <option value="{{ $language->slug }}">{{ $language->name }}</option>
                            @endforeach
                        </select>


                    </div>
                    <button form="ajax-form" class="btn btn-success" type="submit">Add</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Topic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="open"></button>
            </div>
            <div class="modal-body">
                <form id="edit-form" method="post">
                    @csrf

                    <div class=" form-group">
                        <input type="hidden" id="edit-slug" name="slug">

                        <label for="title">Title</label>

                        <input id="edit-title" name="title" type="text" class="form-control" id="title">

                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="edit-description" name="description" class="form-control" id="summernote"
                            rows="4"></textarea>

                    </div>

                    <div class="form-group">
                        <label for="sequence">Sequence</label>
                        <input id="edit-sequence" name="sequence" type="number" class="form-control" id="sequence">

                    </div>

                    <div class="form-group">
                        <label for="language_slug">Programming Language</label>
                        <select id="edit-language_slug" name="language_slug" class="form-control" id="language_slug">
                            @foreach ($languages as $language)
                                <option value="{{ $language->slug }}">{{ $language->name }}</option>
                            @endforeach
                        </select>

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="edit-form">Update</button>
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
                    <table id="myTable" class="table table-bordered" cellspacing="0" cellpadding="5">
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
                                        <a href="#" class="btn btn-sm btn-success edit-btn" data-slug="{{$topic->slug}}"
                                            data-title="{{ $topic->title }}" data-description="{{ $topic->description }}"
                                            data-sequence="{{ $topic->sequence }}"
                                            data-language_slug="{{ $topic->language->slug }}">
                                            <i class="fas fa-edit"></i>
                                        </a>


                                        <!-- Delete Button -->
                                        <a href="" class="btn btn-sm btn-danger delete-btn" data-slug="{{$topic->slug}}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
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

        let formData = new FormData($('#ajax-form')[0]);

        $.ajax({
            url: "{{ route('store.topic') }}",
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 200) {
                    alert('Topic successfully added');
                    location.reload();
                }
            },
            error: function (xhr, status, error) {
                if (xhr.status === 500) {
                    alert('Duplicate name not allowed.');
                }

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (field, messages) {
                        let errorDiv = $('#' + field).closest('.form-group').find('.text-danger');
                        errorDiv.remove();
                        $.each(messages, function (index, message) {
                            $('#' + field).closest('.form-group').append('<div class="text-danger">' + message + '</div>');
                        });
                    });
                }
            }
        });
    });
</script>



<script type="text/javascript">

    $('#myTable').on('click', '.edit-btn', function () {
        var slug = $(this).data('slug');
        var title = $(this).data('title');
        var description = $(this).data('description');
        var sequence = $(this).data('sequence');
        var language_slug = $(this).data('language_slug');

        $('#edit-slug').val(slug);
        $('#edit-title').val(title);
        $('#edit-sequence').val(sequence);
        $('#edit-language_slug').val(language_slug);

        $('#edit-description').summernote('code', description);

        $('#editModal').modal('show');
    });


    $('#edit-form').submit(function (e) {
        e.preventDefault();

        var slug = $('#edit-slug').val();

        let formData = new FormData($('#edit-form')[0]);

        $.ajax({
            url: `/update/topic/${slug}`,
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 200) {
                    alert('Topic successfully updated');
                    location.reload();
                }
            },
        });
    });


    $('#myTable').on('click', '.delete-btn', function (e) {
        e.preventDefault();

        var slug = $(this).data('slug');
        if (confirm("are you sure to delete this item?")) {

            $.ajax({
                url: `/delete/topic/${slug}`,
                method: 'delete',
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status === 200) {
                        alert('{{$topic->title}} successfully deleted');
                        location.reload();
                    }
                },
            });
        }
    });

</script>



@section('scripts')
<script>
    $(document).ready(function () {
        $('#description, #edit-description').summernote({
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