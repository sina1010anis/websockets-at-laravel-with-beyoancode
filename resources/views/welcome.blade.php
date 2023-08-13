<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        <div id="app">
            <p v-for="msg in message">@{{msg}}<br></p>
        </div>
    </body>
    <script src="{{mix('js/app.js')}}"></script>

    <script>
        Echo.channel(`order`)
            .listen('SendEvent', (e) => {
                console.log(e.msg);
            });
    </script>
</html>
