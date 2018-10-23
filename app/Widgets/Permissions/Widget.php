<?php

namespace App\Widgets\Permissions;

use Arrilot\Widgets\AbstractWidget;

class Widget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.permissions.widget', [
            'config' => $this->config,
        ]);
    }
}
