<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{client_1}.{client_2}', function ($user, $client_1, $client_2) {
//    if(in_array($user->role, ['superadmin']) || (int) $user->id === (int) $chat_id) return true;
//    return (int) $user->id === (int) $chat_id;
    if(in_array($user->id, [$client_1, $client_1])) return $user->name;
//    return true;
});
