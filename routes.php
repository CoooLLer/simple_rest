<?php
$routes = [
    [
        'path' => '#\/users\/([0-9]{1,11})\/services\/([0-9]{1,11})\/tarifs$#i',
        'methods' => ['GET'],
        'controller' => 'UserServicesController',
        'action' => 'getUserServiceTariffs'
    ],
    [
        'path' => '#\/users\/([0-9]{1,11})\/services\/([0-9]{1,11})\/tarif$#i',
        'methods' => ['PUT'],
        'controller' => 'UserServicesController',
        'action' => 'setUserServiceTariff'
    ],
];