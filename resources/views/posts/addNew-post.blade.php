@extends('webpost')

@section('content')
<form action="webposts/add" method="post">
    <div class="form-group">
        <label for="Title">Введите заголовок</label>
        <input type="text" name="Title" placeholder="Введите заголовок" id="title">
        <label for="Text">Введите текст записи</label>
    </div>
</form>
@endsection
