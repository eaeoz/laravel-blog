<div class="col-md-4">

    @isset($categories)
        <div class="col-mb-4">
            <div class="card-header">
                <h5>Categories</h5>
            </div>
            <div class="list-group">

                @foreach ($categories as $category)
                    <li class="list-group-item @if(Request::segment(2)==$category->slug) bg-warning @endif"><a @if(Request::segment(2)!=$category->slug)href="{{ route('category', $category->slug) }}"@endif>{{ $category->name }}
                            <span class="badge bg-success float-right text-white">{{ $category->articleCount() }}</span>
                        </a></li>
                @endforeach

            </div>
        </div>
        @endif
        <br>
        {{-- <div class="card mb-4">
            <div class="card-header">
                <h5>Widget</h5>
            </div>
            <div class="card-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus libero necessitatibus
                    odit ipsum vitae consequatur.
                </p>
            </div>
        </div> --}}
    </div>
