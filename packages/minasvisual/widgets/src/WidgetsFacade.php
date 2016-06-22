<?php

namespace Minasvisual\Widgets;

use Illuminate\Support\Facades\Facade;

class WidgetsFacade extends Facade
{
    protected static function getFacadeAccessor() { 
        return 'Widgets';
    }
}
