<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$nameDb = 'vircalendar';

return [
    'db' => [
        'start' => 'mysql:host='. $host,
        'common' => 'mysql:host='.$host.';dbname='.$nameDb,
        'user' => $user,
        'pass' => $pass,
        'options' => [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
    ]
];