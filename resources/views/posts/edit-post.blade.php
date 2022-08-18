@extends("webpost")

@section('content')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light"><b>{{ $post->title }}</b></h1>
                <p class="mb2"><b>Id № </b>: {{ $post->id }}</p>
                <p class="mb2"><b>Text: </b> {{ $post->text }}</p>
                <p class="mb2"><b>Date: </b>{{ $post->date }}</p>
            </div>
        </div>
    </section>
@endsection
