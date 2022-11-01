@extends('back.layouts.master')
@section('content')
@section('title', 'Article List')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{ $articles->count() }}</strong> articles
            found.  <a href="{{ route('admin.trashed.article') }}" class="btn btn-warning btn-sm"> <i class="fa fa-trash"></i> Deleted Articles </a></h6>

    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Article Title</th>
                        <th>Category</th>
                        <th>View Count</th>
                        <th>Created at</th>
                        <th>Status</th>
                        <th>Jobs</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td><img class="rounded" src="{{ asset($article->image) }}" width="100"
                                    height="100"> </td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->getCategory->name }}</td>
                            <td>{{ $article->hit }}</td>
                            <td>{{ $article->created_at->diffForHumans() }}</td>
                            <td>
                                <input type="checkbox" class="switch" article-id="{{ $article->id }}"
                                    data-toggle="toggle" @if ($article->status == 1) checked @endif
                                    data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                    data-width="120" data-height="50">
                            </td>
                            <td>
                                <a href="{{ route('single',[$article->getCategory->slug,$article->slug]) }}" target="_blank" title="View" class="btn btn-sm btn-success"><i class="fa fa-eye"
                                        style="margin: 2px; width: 10px; height: 10px; align-items:center;"></i></a>
                                <a href="{{ route('admin.articlelist.edit', $article->id) }}" title="Edit"
                                    class="btn btn-sm btn-primary"><i class="fa fa-pen"
                                        style="margin: 2px; width: 10px; height: 10px; align-items:center;"></i></a>
                                <a href="{{ route('admin.delete.article', $article->id) }}" title="Delete" class="btn btn-sm btn-danger"><i class="fa fa-times"
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $('.switch').change(function() {
        id = $(this)[0].getAttribute('article-id');
        statu = $(this).prop('checked');
        $.get("{{ route('admin.switch') }}", {
            id: id,
            statu: statu
        });
    })
</script>
@endsection
