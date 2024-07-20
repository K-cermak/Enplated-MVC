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

    //historical reasons, should handle .htaccess
    if (substr($_ENV['REQUEST']['URI'], 0, 7) === 'public/' || str_starts_with(strtolower($_ENV['REQUEST']['URI']), strtolower(getAppEnvVar('BASE_URL') .  'public/'))) {
        if (substr($_ENV['REQUEST']['URI'], 0, 7) === 'public/') {
            $file = getAppEnvVar('BASE_DIRECTORY') . $_ENV['REQUEST']['URI'];
        } else {
            $file = getAppEnvVar('BASE_DIRECTORY') . substr($_ENV['REQUEST']['URI'], strlen(getAppEnvVar('BASE_URL')));
        }

        if (!file_exists($file)) {
            require_once __DIR__ . '/../errors/404.php';
            exit;
        }

        $fileInfo = pathinfo($file);
        $fileType = $fileInfo['extension'];
        $mimeType = mime_content_type($file);

        //for security reasons disable php files 
        if ($fileType === 'php') {
            require_once __DIR__ . '/../errors/404.php';
            exit;
        }

        if ($fileType === 'js' || $fileType === 'css') {
            $mimeType = 'text/' . $fileType;
        }

        header("Content-Type: $mimeType");
        readfile($file);
        exit;
    }

    function convertHexUrl($url) {
        preg_match_all('/%[0-9a-fA-F]{2}/', $url, $matches);
        foreach ($matches[0] as $char) {
            $url = str_replace($char, strtoupper($char), $url);
        }
        return $url;
    }
?>