<?php
    ini_set('display_errors', '0');

    function handle_fatal_error() {
        $error = error_get_last();
        if (is_array($error)) {
            $errorCode = isset($error['type']) ? $error['type'] : 0;
            $errorMsg = isset($error['message']) ? $error['message'] : '';
            $file = isset($error['file']) ? $error['file'] : '';
            $line = isset($error['line']) ? $error['line'] : null;

            if ($errorCode > 0) {
                handle_error($errorCode, $errorMsg, $file, $line);
            }
        }
    }

    function handle_error($code, $msg, $file, $line) {
        //delete all output buffers
        while (ob_get_level() > 0) {
            ob_end_clean();
        }
        if (isset($_ENV['APP']['PRODUCTION']) && (!$_ENV['APP']['PRODUCTION'])) {
            $_ENV['ERROR'] = [
                'code' => $code,
                'msg' => $msg,
                'file' => $file,
                'line' => $line
            ];
            require_once __DIR__ . '/../errors/500-info.php';
        } else {
            require_once __DIR__ . '/../errors/500.php';
        }
        die();
    }

    set_error_handler('handle_error');
    register_shutdown_function('handle_fatal_error');
?>