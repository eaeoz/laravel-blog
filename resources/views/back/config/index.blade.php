@extends('back.layouts.master')
@section('content')
@section('title', 'Settings')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title') </h6>
    </div>
    <div class="card-body">
        <div>
            <form action="{{ route('admin.config.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Basligi</label>
                            <input type="text" name="title" required class="form-congrol" value="{{ $config->title }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="active" class="form-control">
                                <option @if($config->active==1) selected @endif value="1">On</option>
                                <option @if($config->active==0) selected @endif value="0">Off</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Logo</label>
                            <input type="file" class="form-control" name="logo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Site Favicon</label>
                            <input type="file" class="form-control" name="favicon">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control" name="facebook" value="{{ $config->facebook }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control" name="twitter" value="{{ $config->twitter }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Github</label>
                            <input type="text" class="form-control" name="github" value="{{ $config->github }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" class="form-control" name="linkedin" value="{{ $config->linkedin }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>YouTube</label>
                            <input type="text" class="form-control" name="youtube" value="{{ $config->youtube }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" class="form-control" name="instagram" value="{{ $config->instagram }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-md btn-success">Guncelle</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
