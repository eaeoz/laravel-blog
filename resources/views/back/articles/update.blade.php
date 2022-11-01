@extends('back.layouts.master')
@section('content')
@section('title', 'Update Article: '.$articlelisted->title)
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
        <form method="POST" action="{{ route('admin.articlelist.update',$articlelisted->id) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>Article Title</label>
                <input type="text" name="title" class="form-control" value="{{ $articlelisted->title }}" required>
            </div>
            <div class="form-group">
                <label>Category of Article</label>
                <select class="form-control" name="category" required>
                    <option value="">Select a Category</option>
                    @foreach ($categories as $category)
                        <option @if($articlelisted->category_id==$category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Article Picture</label>
                <br>
                <img class="rounded" src="{{ asset($articlelisted->image) }}" height="200" width="200">
                <br>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Article Content</label>
                <textarea id="editor" rows="4" name="content" class="form-control" required>{!! $articlelisted->content !!}</textarea>
            </div>
            <div class="form-group">
                <label>Article Shared Link Url (http or https)</label>
                <input type="text" name="url" class="form-control" value="{{ $articlelisted->url }}" required>
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


