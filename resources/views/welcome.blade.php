<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NativePHP</title>
    @vite('resources/js/app.js')
    <style>
        body.dark {
            background: #222;
            color: white
        }

        body.dark a {
            color: lightblue
        }
    </style>
</head>

<body class="{{ $theme }}">
    <div>
        <a href="/about">About</a>
        <a href="/?openwindow=true">Open Window2</a>
        <a href="/?notification=true">Notify Me</a>
        <a href="/settings">Settings</a>
        <a href="/reddit">Reddit</a>
    </div>
    <div>
        {{ $theme }}
    </div>
    <div>
        Welcome! This is the home page.
    </div>
    <div>
        <div>
            <form action="/user" method="POST">
                @csrf
                <button type="submit">Create user</button>
            </form>
        </div>
        <div>
            @forelse ($users as $user)
            <div>{{$user->name}}</div>
            @empty
            <div>No users found</div>
            @endforelse
        </div>
    </div>
</body>

</html>