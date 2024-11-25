@extends('layouts.index')

@section('body')

<div class="container">
    <div class="row">
        <div class="col-md-10 offset-1 mt-2 ">
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
                                        <a href="{{ route('edit.topic', $topic->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>

                                        <!-- Delete Button -->
                                        <a href="{{ route('destroy.topic', $topic->id) }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this topic?');">Delete</a>
                                        </>
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

@endsection