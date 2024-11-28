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
                <h1>Add New </h1>
            </div>
            <div class="modal-body">
                <form id="ajax-form" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" class="form-control">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
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
                    <div class="form-group">
                        <input type="hidden" id="edit-slug" name="slug">
                        <label for="name">Name</label>
                        <input id="edit-name" name="name" type="text" class="form-control">
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
        <div class="col-md-6 offset-2 mt-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                Add Language
            </button>
            <div class="card">
                <div class="card-header bg-info">
                </div>
                <div class="card-body col-md-12">
                    <table id="table" class="table" border="1" cellspacing="0" cellpadding="5">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Total Topics</th>


                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($languages as $language)
                                <tr>
                                    <td>{{ $language->name }}</td>
                                    <td>{{ $language->topic_count }}</td>

                                    <td>
                                        <a href="#" class="btn btn-sm btn-success edit-btn" data-name="{{$language->name}}"
                                            data-slug="{{$language->slug}}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="" class="btn btn-sm btn-danger delete-btn" data-slug="{{$language->slug}}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    $('#ajax-form').submit(function (e) {
        e.preventDefault();

        let formData = new FormData($('#ajax-form')[0]);

        $.ajax({
            url: "{{ route('store.language') }}",
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
                    alert("Added Done");
                    location.reload();
                }
            },
            error: function (xhr, status, error) {

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

    $('#table').on('click', '.edit-btn', function () {
        var slug = $(this).data('slug');
        var name = $(this).data('name');

        $('#edit-slug').val(slug);
        $('#edit-name').val(name);

        $('#editModal').modal('show');
    });



    $('#edit-form').submit(function (e) {
        e.preventDefault();

        var slug = $('#edit-slug').val();

        let formData = new FormData($('#edit-form')[0]);

        $.ajax({
            url: `/update/language/${slug}`,
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
                    alert('{{$language->name}} successfully updated');
                    location.reload();
                }
            },
        });
    });


    $('#table').on('click', '.delete-btn', function (e) {
        e.preventDefault();

        var slug = $(this).data('slug');

        if (confirm("are you sure to delete this item?")) {
            $.ajax({
                url: `/delete/language/${slug}`,
                method: 'delete',
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status === 200) {
                        alert('{{$language->name}} successfully deleted');
                        location.reload();
                    }
                },
            });
        }

    });

</script>

@endsection