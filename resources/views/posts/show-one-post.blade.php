<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>
    <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
</head>

<body>
<div class="mw6 center pa3 sans-serif">
    <h1 class="mb4">Posts</h1>

        <div class="pa2 mb3 striped--near-white">
            <header class="b mb2">{{ $post->title }}</header>
            <div class="pl2">
                <p class="mb2">id: {{ $post->id }}</p>
                <p class="mb2">details: {{ $post->text }}</p>
                <p class="mb2">Date: {{ $post->date }}</p>
            </div>
        </div>

</div>
</body>
</html>
