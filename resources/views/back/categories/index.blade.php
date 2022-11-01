@extends('back.layouts.master')
@section('content')
@section('title', 'All Categories')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create New Category</h6>

            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.category.create') }}">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Article Count</th>
                                <th>Status</th>
                                <th>Jobs</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->articleCount() }}</td>
                                    <td>
                                        <input type="checkbox" class="switch" category-id="{{ $category->id }}"
                                            data-toggle="toggle" @if ($category->status == 1) checked @endif
                                            data-on="Enabled" data-off="Disabled" data-onstyle="success"
                                            data-offstyle="danger" data-width="120" data-height="50">
                                    </td>
                                    <td>
                                        <a category-id="{{ $category->id }}" title="Edit This Category"
                                            class="btn btn-sm btn-primary edit-click"><i
                                                class="fa fa-edit text-white"></i> </a>
                                        <a category-id="{{ $category->id }}" category-count="{{ $category->articleCount() }}" category-name="{{ $category->name }}" title="Delete This Category"
                                            class="btn btn-sm btn-danger remove-click"><i
                                                class="fa fa-times text-white"></i> </a>
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
<!-- The Modal -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.category.update') }}">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input id="category" type="text" class="form-control" name="category">
                        <input type="hidden" name="id" id="category_id">
                    </div>
                    <div class="form-group">
                        <label>Category Slug</label>
                        <input id="slug" type="text" class="form-control" name="slug">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="body">
                <div id="articleAlert" class="alert alert-danger">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <form method="POST" action="{{ route('admin.category.delete') }}">
                    @csrf
                    <input type="hidden" name="id" id="DeleteID">
                <button type="submit" id="DeleteButton" class="btn btn-success">Delete</button>
            </form>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $('.edit-click').click(function() {
        id = $(this)[0].getAttribute('category-id');
        $.ajax({
            type: 'GET',
            url: '{{ route('admin.category.getdata') }}',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#category_id').val(data.id);
                $('#category').val(data.name);
                $('#slug').val(data.slug);
                $('#editModal').modal();
            }
        });
    });
    $('.remove-click').click(function() {
        id = $(this)[0].getAttribute('category-id');
        count = $(this)[0].getAttribute('category-count');
        name = $(this)[0].getAttribute('category-name');
        $('.modal-title').html('Delete category - '+name);
        if(id==1){
            $('#articleAlert').html(name+" category is permenant type. If you delete any one of the categories, they will be transferred to this category.");
            $('#body').show();
            $('#DeleteButton').hide();
            $('#deleteModal').modal();
            return;
        }

        $('#DeleteButton').show();
        $('#DeleteID').val(id);
        $('#articleAlert').html('');
        $('#body').hide();
        if(count>0){
            $('#articleAlert').html(count+' article found. Still want to delete?');
            $('#body').show();
        }
        $('#deleteModal').modal();
    });
    $('.switch').change(function() {
        id = $(this)[0].getAttribute('category-id');
        statu = $(this).prop('checked');
        $.get("{{ route('admin.category.switch') }}", {
            id: id,
            statu: statu
        });
    })
</script>
@endsection
