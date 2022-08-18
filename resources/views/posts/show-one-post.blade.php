@extends("webpost")

@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">
                    <b>{{ $post->title }}</b>
                </h1>
                <p class="mb2">
                    <b>Id № </b>: {{ $post->id }}
                </p>
                <p class="mb2">
                    <b>Text: </b> {{ $post->text }}
                </p>
                <p class="mb2">
                    <b>Date: </b>{{ $post->date }}
                </p>
            </div>
            @if(auth()->user())
                @if(auth()->user()->id == $post->user_id)
                    <p>
                        <a href="{{route('postEdit', $post->id)}}">
                            <button type="submit" class="btn btn-primary">Редактировать</button>
                        </a>
                    </p>
                    <p>
                        <a href="{{route('postDelete', $post->id)}}">
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </a>
                    </p>
                @endif
            @endif
        </div>
    </section>
@endsection
