<?php

require __DIR__ . "/../vendor/autoload.php";

$client = new UberProxy\Client("localhost", "8e0c5e97f91e1a8dde85702ffadff48e8488fda46c457712920aa835dabe25c8");
assert($client->ping()['pong'] === true);
