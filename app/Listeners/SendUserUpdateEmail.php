<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserUpdateEmail
{
    /**
     * Create the event listener.
     */
    public function __construct(User $user)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //send update email !!
    }
}
