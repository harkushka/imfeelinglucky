<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register</title>
    </head>
    <body>
        <div>
            <form method="post" action="/user">
                @csrf
                <div>
                    <p>Username:</p>
                    <input name="name" />
                </div>
                <div>
                    <p>Phonenumber:</p>
                    <input name="phone" />
                </div>
                <button style="padding: 5px 10px; margin-top: 10px;">Register</button>
            </form>
        </div>
    </body>
</html>
