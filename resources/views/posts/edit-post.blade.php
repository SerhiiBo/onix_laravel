@extends('webpost')

@section('content')


    <div style="width: 50%; margin: 20px auto;">
        <form action="{{route('postEditSubmit', $post->id)}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Введите заголовок</label>
                <input type="text" name="title" placeholder="Введите заголовок" id="title" class="form-control" value="{{ $post->title }}">
            </div>
            </br>
            <div class="form-group">
                <label for="text">Введите текст записи</label>
                <textarea name="text" placeholder="Введите текст" id="text" class="form-control">{{ $post->text }}</textarea>
            </div>
            </br>
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </div>
@endsection
