<?php
    //get request scheme (REQUEST_SCHEME is not set on every server, e.g. nginx or PHP built-in server)
    if (isset($_SERVER['REQUEST_SCHEME'])) {
        $scheme = $_SERVER['REQUEST_SCHEME'];
    } else if ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== '' && strtolower($_SERVER['HTTPS']) !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) {
        $scheme = 'https';
    } else {
        $scheme = 'http';
    }

    //get host (HTTP_HOST is missing when request has no Host header)
    $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];

    //get request uri with scheme and host
    $request = $scheme . '://' . $host . $_SERVER['REQUEST_URI'];
    //remove trailing slash
    if (substr($request, -1) === '/') {
        $request = substr($request, 0, -1);
    }

    if ((strtolower($request) === strtolower(getAppEnvVar('BASE_URL'))) || (strtolower($request) . '/' === strtolower(getAppEnvVar('BASE_URL')))) {
        $request = '/';
    } else {
        $request = str_replace(getAppEnvVar('BASE_URL'), '', $request);
        $request = str_replace(convertHexUrl(getAppEnvVar('BASE_URL')), '', $request);
    }

    $_ENV['REQUEST'] = [
        'URI' => $request,
        'METHOD' => $_SERVER['REQUEST_METHOD'],
    ];

    function convertHexUrl($url) {
        preg_match_all('/%[0-9a-fA-F]{2}/', $url, $matches);
        foreach ($matches[0] as $char) {
            $url = str_replace($char, strtoupper($char), $url);
        }
        return $url;
    }
?>