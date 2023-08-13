
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

If it gives the following error, we delete the following value from the <b>package.json</b> file.<br>
```bash
<p>
[webpack-cli] Error [ERR_REQUIRE_ESM]: require() of ES Module C:\xampp\htdocs\project\chat_app\webpack.mix.js from C:\xampp\htdocs\project\chat_app\node_modules\laravel-mix\setup\webpack.config.js not supported.
webpack.mix.js is treated as an ES module file as it is a .js file whose nearest parent package.json contains "type": "module" which declares all .js files in that package scope as ES modules.
Instead rename webpack.mix.js to end in .cjs, change the requiring code to use dynamic import() which is available in all CommonJS modules, or change "type": "module" to "type": "commonjs" in C:\xampp\htdocs\project\chat_app\package.json to treat all .js files as CommonJS (using .mjs for all ES modules instead).

    at module.exports (C:\xampp\htdocs\project\chat_app\node_modules\laravel-mix\setup\webpack.config.js:11:5)
    at loadConfigByPath (C:\xampp\htdocs\project\chat_app\node_modules\webpack-cli\lib\webpack-cli.js:1439:37)
    at async Promise.all (index 0)
    at async WebpackCLI.loadConfig (C:\xampp\htdocs\project\chat_app\node_modules\webpack-cli\lib\webpack-cli.js:1454:35)
    at async WebpackCLI.createCompiler (C:\xampp\htdocs\project\chat_app\node_modules\webpack-cli\lib\webpack-cli.js:1785:22)
    at async WebpackCLI.runWebpack (C:\xampp\htdocs\project\chat_app\node_modules\webpack-cli\lib\webpack-cli.js:1890:20)
    at async Command.<anonymous> (C:\xampp\htdocs\project\chat_app\node_modules\webpack-cli\lib\webpack-cli.js:912:21)
    at async Promise.all (index 1)
    at async Command.<anonymous> (C:\xampp\htdocs\project\chat_app\node_modules\webpack-cli\lib\webpack-cli.js:1372:13) {
  code: 'ERR_REQUIRE_ESM'
}
</p>
```
```bash
-     "type": "module",

```
