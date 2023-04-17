<?php

namespace App\Subscribers\User;

use App\Events\Models\User\UserCreated;
use App\Events\Models\User\UserUpdated;
use App\Events\UserDeleted;
use App\Listeners\SendUserDeleteEmail;
use App\Listeners\SendUserUpdateEmail;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Events\Dispatcher;

class UserSubscriber
{
    public function subscribe(Dispatcher $event)
    {
        $event->listen(UserCreated::class,SendWelcomeEmail::class);
        $event->listen(UserUpdated::class,SendUserUpdateEmail::class);
        $event->listen(UserDeleted::class, SendUserDeleteEmail::class);
    }
}
