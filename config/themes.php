<?php

return [

    'frontend' => 'default.layout',
    'backend' => 'exemplo.index',

    'path' => base_path('resources/themes'),

    'cache' => [
        'enabled' => false,
        'key' => 'pingpong.themes',
        'lifetime' => 86400,
    ],

];
