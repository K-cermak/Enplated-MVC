<?php
    checkRoute('GET', '/login', function() {
        if (isset($_SESSION["loggedId"])) {
            header("Location: " . getAppEnvVar("BASE_URL") . "/admin");
            die();
        }

        $template = processTemplate('login', ["title" => 'Login']);
        finishRender($template);
    });


    checkRoute('POST', '/login', function() {
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            $_SESSION["errorMessage"] = "Invalid username or password";
            header("Location: " . getAppEnvVar("BASE_URL") . "/login");
            die();
        }

        $userId = modelCall('users', 'getUserId', ['db' => getDatabaseEnvConn('db'), 'username' => $_POST['username']]);
        if (!$userId) {
            $_SESSION["errorMessage"] = "Invalid username";
            header("Location: " . getAppEnvVar("BASE_URL") . "/login");
            die();
        }

        if (!modelCall('users', 'checkPassword', ['db' => getDatabaseEnvConn('db'), 'id' => $userId, 'password' => $_POST['password']])) {
            $_SESSION["errorMessage"] = "Invalid password";
            header("Location: " . getAppEnvVar("BASE_URL") . "/login");
            die();
        }
        
        $_SESSION["loggedId"] = $userId;
        header("Location: " . getAppEnvVar("BASE_URL") . "/admin");
    });

    checkRoute('GET', '/logout', function() {
        unset($_SESSION["loggedId"]);
        $_SESSION["successMessage"] = "You have been logged out";

        if (isset($_GET["changedPassword"])) {
            $_SESSION["successMessage"] = "Password changed successfully, please login again";
        }
        header("Location: " . getAppEnvVar("BASE_URL") . "/login");
    });

    checkRoute('GET', '/admin', function() {
        modelCall('helpers', 'checkLogged');
        $template = processTemplate('admin/index', ["title" => 'Admin Dashboard']);
        finishRender($template);
    });
?>