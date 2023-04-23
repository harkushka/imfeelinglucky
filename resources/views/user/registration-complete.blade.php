<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registration complete</title>
    </head>
    <body>
        <div>
            <div>
                <h3>Registration complete!</h3>
                <div>User url: <a href="{{ $link }}">{{ $link }}</a></div>
            </div>
        </div>
    </body>
</html>
