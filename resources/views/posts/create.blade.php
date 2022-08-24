@extends('layouts.app')

@section('content')
    <div style="width: 50%; margin: 20px auto;">
        <form action="{{route('create_post')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">Введите заголовок</label>
                <input type="text" name="title" placeholder="Введите заголовок" id="title" class="form-control"
                       value="{{ old('title') }}">
            </div>
            </br>
            <div class="form-group">
                <label for="text">Введите текст записи</label>
                <textarea name="text" placeholder="Введите текст" id="text"
                          class="form-control">{{ old('text') }}</textarea>
            </div>
            </br>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
