<?php
    function checkLogged() {
        if (!isset($_SESSION["loggedId"])) {
            header("Location: " . getAppEnvVar("BASE_URL") . "/login");
            die();
        }
    }

    function isLogged() {
        if (!isset($_SESSION["loggedId"])) {
            http_response_code(403);
            resourceView([
                "code" => 403,
                "message" => "Not logged",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }
    }
?>