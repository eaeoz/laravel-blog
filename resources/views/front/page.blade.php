@extends('front.layouts.master')
@section('title',Str::limit($page->title,30))
@section('image',$page->image)
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <img src="{{ $page->image }}" class="card-img-top img-thumbnail" alt="">
            <div class="card-body">

                <h4 class="card-title">{{ $page->title }}</h4>
                <p class="card-text">
                    {!! $page->content !!}
                </p>
                <br>
                <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-primary">Return</button>
                </a>
            </div>

        </div>
    </div>

@endsection
