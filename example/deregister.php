<?php

require __DIR__ . "/common.php";

$client->deregister()
    ->worker('localhost:3333')
    ->host('domain2.foobar.net')
    ->send();

