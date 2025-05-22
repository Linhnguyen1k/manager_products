<?php
require 'vendor/autoload.php';

use Predis\Client;

$client = new Client([
    'host'     => 'redis-11629.c263.us-east-1-2.ec2.redns.redis-cloud.com',
    'port'     => 11629,
    'username' => 'default',
    'password' => 'bLHoZy7xivKL2JIhWkxTr2JqY8Ruypyq',
    'database' => 0,
    'ssl'      => ['verify_peer' => false], // Nếu Redis yêu cầu TLS
]);

$client->set('hello', 'world');
echo $client->get('hello');
