@if(count($articles)>0)
@foreach ($articles as $article)
    <div class="card mb-4">
        <img src="{{ $article->image }}" class="card-img-top img-thumbnail" alt="">
        <div class="card-body">

            <h4 class="card-title">{{ $article->title }}</h4>
            <p class="card-text">
                {!! Str::limit($article->content, 150) !!}
            </p>
            <a href="{{ route('single', [$article->getCategory->slug, $article->slug]) }}">
                <button type="button" class="btn btn-primary">Read More</button>
            </a>
        </div>
        <div class="card-footer text-muted">
            Category :
            {{ $article->getCategory->name }}
            <span class="float-right"> {{ $article->created_at->diffForHumans() }}</span>
        </div>
    </div>
    @if ($loop->last)
        <hr>
    @endif
@endforeach
{{ $articles->links('pagination::bootstrap-4') }}
@else
<div class="alert alert-danger">
    <h1>No article found</h1>
</div>
@endif
