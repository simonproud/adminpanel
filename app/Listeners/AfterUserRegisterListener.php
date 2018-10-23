<?php

namespace App\Listeners;

use App\Events\AfterUserRegisterEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AfterUserRegisterListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AfterUserRegisterEvent  $event
     * @return void
     */
    public function handle(AfterUserRegisterEvent $event)
    {
        //
    }
}
