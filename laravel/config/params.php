<?php

return [
    'site_name' => env('APP_NAME'),
    'currencies' => [
        'USD' => ['symbol' => '$', 'name' => 'US Dollors'],
        'EUR' => ['symbol' => '‎€', 'name' => 'Euro'],
    ],
    'currency_default' => 'USD',
    'languages' => [
        'en_uk' => 'English (UK)',
        'en_us' => 'English (US)',
    ],
    'language_default' => 'en_uk',
    'contentTypes' => [
        'page' => 'Page',
        'email' => 'Email',
        'block' => 'Block',
    ],
    'weekdays' => [
        1 => 'Mon',
        2 => 'Tue',
        3 => 'Wed',
        4 => 'Thu',
        5 => 'Fri',
        6 => 'Sat',
        7 => 'Sun'
    ],
];
