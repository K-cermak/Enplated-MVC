<?php
    //get request uri with host and ssl
    $request = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //remove slash at the end
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