<?php

namespace Minasvisual\Widgets;

use Closure;
use Illuminate\Container\Container;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;

class Widgets
{
   public static $langs = [
            'es' => 'www.domain.es',
            'en' => 'www.domain.us',
            'uk' => 'www.domain.uk',
            'br' => 'www.domain.br',
            'it' => 'www.domain.it',
            'de' => 'www.domain.de',
            'fr' => 'www.domain.fr'
        ];
}
