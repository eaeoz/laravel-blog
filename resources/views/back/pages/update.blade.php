@extends('back.layouts.master')
@section('content')
@section('title', 'Update Page: '.$page->title)
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('admin.page.edit',$page->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Page Title</label>
                <input type="text" name="title" class="form-control" value="{{ $page->title }}" required>
            </div>
            <div class="form-group">
                <label>Page Picture</label>
                <br>
                <img class="rounded" src="{{ asset($page->image) }}" height="200" width="200">
                <br>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Page Content</label>
                <textarea id="editor" rows="4" name="content" class="form-control" required>{!! $page->content !!}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editor').summernote({
            'height': 300
        });
    });
</script>
@endsection


