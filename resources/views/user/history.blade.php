<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register</title>
    </head>
    <body>
        <div>
            <div>
                <p><i><a href="{{ route('user', ['token' => $user['token']]) }}">Back</a></i></p>
                <p>Username: {{ $user['name'] }}</p>
                <p>Phone: {{ $user['phone'] }}</p>
                <p>
                    <form method="post" action="{{ route('deactivateUser', ['token' => $user['token']]) }}">
                        @csrf
                        <button style="padding: 5px 10px; margin-top: 10px;">Deactivate user</button>
                    </form>
                </p>
                <p>
                    <form method="post" action="{{ route('updateLink', ['token' => $user['token']]) }}">
                        @csrf
                        <button style="padding: 5px 10px; margin-top: 10px;">Update link</button>
                    </form>
                </p>
                <hr>
                <p>Last attempts:</p>
                @foreach($histories as $history)
                    <div style="border: 1px; padding: 10px;">
                        <p>Number: {{ $history['random_number'] }}</b></p>
                        <p>You {{ $history['win'] ? 'win!' : 'lose!' }}</p>
                        <p>Your gain: {{ $history['sum'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
