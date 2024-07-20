<?php
    function modelCall($modelName, $modelFunction, $modelParams = []) {
        $modelPath = __DIR__ . '/'. $modelName . '.php';
        if (!file_exists($modelPath)) {
            return false;
        }

        require_once $modelPath;
        if (!function_exists($modelFunction)) {
            return false;
        }

        //create vars for each param
        foreach ($modelParams as $key => $value) {
            $$key = $value;
        }
        return $modelFunction(...$modelParams);
    }
?>