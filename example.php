<?php

require __DIR__ . "/vendor/autoload.php";

$client = new UberProxy\Client("localhost", "8e0c5e97f91e1a8dde85702ffadff48e8488fda46c457712920aa835dabe25c8");
assert($client->ping()['pong'] === true);

$response = $client->register()
    ->addClient('localhost:3333')
    ->addHost('domain1.foobar.net')
    ->enablePlugin('redirect')
    ->extra([
        'redirectTo' => ['https://domain2.foobar.net/',  301]
    ])
    ->send();
assert($response['error'] === false);

// Get Information
var_dump($client->getInfo());
