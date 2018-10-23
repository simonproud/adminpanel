<?php

namespace Modules\CRM\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CRMLeadCreated::class => [
            NotifyLeadCreated::class,
        ],
    ];
}
