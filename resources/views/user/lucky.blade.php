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
                <p></p>
                <p><b>{{ $history['random_number'] }}</b></p>
                <p>You {{ $history['win'] ? 'win!' : 'lose!' }}</p>
                <p>Your gain: {{ $history['sum'] }}</p>
                <p></p>
                <p>
                    <form method="post" action="{{ route('lucky', ['token' => $user['token']]) }}">
                        @csrf
                        <button style="padding: 5px 10px; margin-top: 10px;">Imfeelinglucky</button>
                    </form>
                </p>
                <p><a href="{{ route('history', ['token' => $user['token']]) }}">History</a></p>
            </div>
        </div>
    </body>
</html>
