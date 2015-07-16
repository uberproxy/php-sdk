<?php

require __DIR__ . "/common.php";

$response =$client->addSsl('domain2.foobar.net')
    ->addCert('mysitename.crt')
    ->addKey('mysitename.key')
    ->send();
assert($response['error'] === false);
