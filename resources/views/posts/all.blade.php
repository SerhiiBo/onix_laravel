@extends('layouts.app')

@section('content')
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light"><b>All Posts</b></h1>
                </div>
            </div>
        </section>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($posts as $post)
                        <div class="col">
                            <div class="card shadow-sm">
                                <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                     xmlns="http://www.w3.org/2000/svg" role="img"
                                     aria-label="Placeholder: Post picture" preserveAspectRatio="xMidYMid slice"
                                     focusable="false"><title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c"></rect>
                                    <text x="50%" y="50%" fill="#eceeef" dy=".3em">Post picture</text>
                                </svg>
                                <div class="card-body">
                                    <p class="card-text">Title:
                                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{route('showOne', $post->id)}}">
                                                <button type="button" class="btn btn-sm btn-outline-secondary">View
                                                </button>
                                            </a>
                                            @if(auth()->user())
                                                @if(auth()->user()->id == $post->user_id)
                                                    <a href="{{route('edit_post', $post->id)}}">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                                            Edit
                                                        </button>
                                                    </a>
                                                @endif
                                            @endif
                                        </div>
                                        <small class="text-muted"><b>date:</b>{{ $post->date }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div>
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
