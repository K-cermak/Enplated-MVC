<?php
    function modelCall($modelName, $modelFunction, $modelParams = []) {
        $modelPath = __DIR__ . '/'. $modelName . '.php';
        if (!file_exists($modelPath)) {
            throw new Exception("Model file '" . $modelPath . "' not found");
            return false;
        }

        require_once $modelPath;
        if (!function_exists($modelFunction)) {
            throw new Exception("Model function '" . $modelFunction . "()' not found");
            return false;
        }

        //create vars for each param
        foreach ($modelParams as $key => $value) {
            $$key = $value;
        }
        return $modelFunction(...$modelParams);
    }
?>