<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$nameDb = 'virtcalendar';

return [
    'db' => [
        'start' => 'mysql:host='. $host,
        'common' => 'mysql:host='.$host.';dbname='.$nameDb,
        'nameDb' => $nameDb,
        'user' => $user,
        'pass' => $pass,
        'options' => [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    ],
    'site' => [
        'name' => 'VirtCalendar',
        'correo' => 'juandarojas01@gmail.com'
    ]
];