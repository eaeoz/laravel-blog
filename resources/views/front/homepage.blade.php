@extends('front.layouts.master')
@section('title', $config->title)
@section('image', asset('front/1.jpg'))
@section('content')
    <div class="col-md-8">
        @include('front.widgets.articlelist')
    </div>
    @include('front.widgets.categorywidget')
@endsection
