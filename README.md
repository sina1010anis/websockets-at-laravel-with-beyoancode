
## Installation:
```bash
#In this tutorial, the old version is used because the new versions are beta and do not work
composer require beyondcode/laravel-websockets:1.14.0 -W
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
php artisan migrate
php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"

composer require laravel/ui
php artisan ui bootstrap --auth

npm i laravel-echo
npm i pusher-js
npm i vue@next
#In this tutorial, we have to migrate from vite to laravel mix, please check the link below
#https://github.com/laravel/vite-plugin/blob/main/UPGRADE.md#migrating-from-vite-to-laravel-mix

#We put the following values in the .env file and they must be fake
PUSHER_APP_ID=1111122222
PUSHER_APP_KEY=1111122222
PUSHER_APP_SECRET=1111122222
PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http
PUSHER_APP_CLUSTER=mt1

#In the config/app.php file, the value (App\Providers\BroadcastServiceProvider::class),Get it from Comet, which is in the providers section
App\Providers\BroadcastServiceProvider::class,

#In the file js/bootstrap.js with line 20 and beyond, put the following values from the comment in biorim.
import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '1111122222',
    cluster:'mt1',
    wsHost: 'localhost',
    wsPort: 6001,
    wssPort: 6001,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
});

#Now inside any part of the page, for example inside mounted or welcome.blade.php itself, you can put the value to execute the Echo commands to use the listen command.

Echo.channel(`The name of the channel that is in the event file (new Channel('order'))`)
    .listen('name event (SendMsg)', (e) => {
        console.log(e.msg);
    });

#Now, if the desired event is called anywhere, it will be executed wherever listen is used, and the broadcastWith function inside the event will be executed.

```
