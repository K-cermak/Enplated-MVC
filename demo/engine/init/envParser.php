<?php
    //load the .env file into the $_ENV superglobal
    $env = parse_ini_file(__DIR__ . '/../../.env', true);

    foreach($env as $key => $value) {
        $_ENV['APP'][$key] = $value;
    }

    if (!isset($_ENV['APP']['BASE_DIRECTORY'])) {
        $_ENV['APP']['BASE_DIRECTORY'] = __DIR__ . '/../../';
    }
?>