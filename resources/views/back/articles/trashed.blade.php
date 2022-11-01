@extends('back.layouts.master')
@section('content')
@section('title', 'Article List')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-right"><strong>{{ $articles->count() }}</strong> articles
            found. <a href="{{ route('admin.articlelist.index') }}" class="btn btn-primary btn-sm"></i> Active Articles </a></h6>

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
                            <td><img class="rounded" src="{{ asset($article->image) }}" width="100" height="100">
                            </td>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->getCategory->name }}</td>
                            <td>{{ $article->hit }}</td>
                            <td>{{ $article->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.recover.article', $article->id) }}" title="Recover"
                                    class="btn btn-sm btn-primary"><i class="fa fa-recycle"
                                        style="margin: 2px; width: 10px; height: 10px; align-items:center;"></i></a>
                                <a href="{{ route('admin.hard.delete.article', $article->id) }}" title="Delete"
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
