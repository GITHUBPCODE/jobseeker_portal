<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(UserCreated $event)
    {
        Mail::to($event->user->email)->send(new WelcomeMail($event->user));
    }
}