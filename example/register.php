<?php

require __DIR__ . "/common.php";

$response = $client->register()
    ->worker('localhost:3333')
    ->addHost('domain2.foobar.net')
    ->send();
assert($response['error'] === false);

$response = $client->register()
    ->worker('localhost:3333')
    ->addHost('domain1.foobar.net')
    ->enablePlugin('redirect')
    ->extra([
        'redirectTo' => ['https://domain2.foobar.net/',  301]
    ])
    ->send();
assert($response['error'] === false);
