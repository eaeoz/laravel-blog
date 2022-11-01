@extends('back.layouts.master')
@section('content')
@section('title', 'Page List')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{ $pages->count() }}</strong> pages
            found. </h6>

    </div>
    <div class="card-body">
        <div id="orderSuccess" style="display: none;" class="alert alert-success">
            Successfully sorted.
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Line</th>
                        <th>Picture</th>
                        <th>page Title</th>
                        <th>Status</th>
                        <th>Jobs</th>
                    </tr>
                </thead>

                <tbody id="orders">
                    @foreach ($pages as $page)
                        <tr id="page_{{ $page->id }}">
                            <td class="text-center" style="width:3%"><i class="fa fa-arrows-alt-v fa-3x handle" style="cursor: move;"></i></td>
                            <td><img class="rounded" src="{{ asset($page->image) }}" width="100" height="100"> </td>
                            <td>{{ $page->title }}</td>
                            <td>
                                <input type="checkbox" class="switch" page-id="{{ $page->id }}" data-toggle="toggle"
                                    @if ($page->status == 1) checked @endif data-on="Enabled"
                                    data-off="Disabled" data-onstyle="success" data-offstyle="danger" data-width="120"
                                    data-height="50">
                            </td>
                            <td>
                                <a href="{{ route('page', $page->slug) }}" target="_blank" title="View"
                                    class="btn btn-sm btn-success"><i class="fa fa-eye"
                                        style="margin: 2px; width: 10px; height: 10px; align-items:center;"></i></a>
                                <a href="{{ route('admin.page.update', $page->id) }}" title="Edit"
                                    class="btn btn-sm btn-primary"><i class="fa fa-pen"
                                        style="margin: 2px; width: 10px; height: 10px; align-items:center;"></i></a>
                                <a href="{{ route('admin.page.delete', $page->id) }}" title="Delete"
                                    class="btn btn-sm btn-danger"><i class="fa fa-times"
                                        style="margin: 2px; width: 10px; height: 10px; align-items:center;"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script>
    $('#orders').sortable({
        handle:'.handle',
        update:function(){
            var siralama = $('#orders').sortable('serialize');
            $.get("{{ route('admin.page.orders') }}?"+siralama,function(data,status){
                $("#orderSuccess").show().delay(1000).fadeOut();
            });
        }
    });
</script>
<script>
    $('.switch').change(function() {
        id = $(this)[0].getAttribute('page-id');
        statu = $(this).prop('checked');
        $.get("{{ route('admin.page.switch') }}", {
            id: id,
            statu: statu
        });
    })
</script>
@endsection
