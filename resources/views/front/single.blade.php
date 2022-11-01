@extends('front.layouts.master')
@section('title','Post : '. Str::limit($article->title,30))
@section('image',$article->image)
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <img src="{{ asset($article->image) }}" class="card-img-top img-thumbnail" alt="">
            <div class="card-body">

                <h4 class="card-title">{{ $article->title }}</h4>
                <p class="card-text">
                    {!! $article->content !!}
                </p>
                <p class="lead mb-0">
                    @if ($article->url!='')
                    <a href="{{ $article->url }}" class="text-black font-black-bold" target='_blank' >Link...</a>
                    @else
                    <h6 class="text-black font-black-bold">( No Link Attached )</h6>
                    @endif
                </p>
                <br>
                <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-primary">Return</button>
                </a>
            </div>
            <div class="card-footer text-muted">
                Category :
                <b class="text-success">
                    {{ $article->getCategory->name }}</b>
                    <span class="float-right">View count: <b class="text-danger">{{ $article->hit }} </b> - Posted at  {{ $article->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>

@endsection
