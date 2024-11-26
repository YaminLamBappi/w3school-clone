@extends('layouts.index')

@section('body')


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Language</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('store.language') }}">
                    @csrf
                    <input name="name" type="text">

                </form>

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button class="btn btn-success btn-md" type="submit">Add</button>


            </div>


        </div>
    </div>
</div>




<div class="container">
    <div class="row">
        <div class="col-md-6 offset-2 mt-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                Add Language
            </button>
            <div class="card">
                <div class="card-header bg-info">
                </div>
                <div class="card-body col-md-12">
                    <table class="table" border="1" cellspacing="0" cellpadding="5">
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
                                        <a href="{{ route('edit.language', $language->slug) }}"
                                            class="btn btn-sm btn-primary"><i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('destroy.language', $language->slug) }}"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this item?');"> <i
                                                class="fas fa-trash"></i>
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
@endsection