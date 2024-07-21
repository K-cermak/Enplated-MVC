<?php
/*PROFILE*/
    checkRoute("GET", "/admin/profile", function() {
        modelCall("helpers", "checkLogged");
        $username = modelCall("users", "getUsername", ["db" => getDatabaseEnvConn("db"), "id" => $_SESSION["loggedId"]]);
        $template = processTemplate("admin/profile", ["title" => "My Profile", "userId" => $_SESSION["loggedId"], "username" => $username]);
        finishRender($template);
    });


    checkRoute("PATCH", "/admin/profile/changeUsername", function() {
        modelCall("helpers", "isLogged");

        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data["newUsername"])) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Username is required",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        $username = $data["newUsername"];
        $userId = $_SESSION["loggedId"];

        if (strlen($username) < 3 || strlen($username) > 50) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Username must be at least 3 characters long and not longer than 50 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        //check if not exist
        if (modelCall("users", "getUserId", ["db" => getDatabaseEnvConn("db"), "username" => $username])) {
            http_response_code(409);
            resourceView([
                "code" => 409,
                "message" => "Username already exists",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        modelCall("users", "changeUsername", ["db" => getDatabaseEnvConn("db"), "id" => $userId, "newUsername" => $username]);

        http_response_code(200);
        resourceView([
            "code" => 200,
            "message" => "Username changed",
            "time" => date("Y-m-d H:i:s")
        ], "json");
    });


    checkRoute("PATCH", "/admin/profile/changePassword", function() {
        modelCall("helpers", "isLogged");

        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data["oldPassword"]) || !isset($data["newPassword"])) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Missing required fields",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        $oldPassword = $data["oldPassword"];
        $newPassword = $data["newPassword"];
        $userId = $_SESSION["loggedId"];

        if (strlen($newPassword) < 6) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Password must be at least 6 characters long",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        //check if old password is correct
        if (!modelCall("users", "checkPassword", ["db" => getDatabaseEnvConn("db"), "id" => $userId, "password" => $oldPassword])) {
            http_response_code(401);
            resourceView([
                "code" => 401,
                "message" => "Old password is incorrect",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        modelCall("users", "changePassword", ["db" => getDatabaseEnvConn("db"), "id" => $userId, "newPassword" => $newPassword]);

        http_response_code(200);
        resourceView([
            "code" => 200,
            "message" => "Password changed",
            "time" => date("Y-m-d H:i:s")
        ], "json");
    });



/*USERS*/
    checkRoute("GET", "/admin/users", function() {
        modelCall("helpers", "checkLogged");
        $users = modelCall("users", "getUsersWithPostNum", ["db" => getDatabaseEnvConn("db")]);
        $template = processTemplate("admin/users", ["title" => "Users", "users" => $users]);
        finishRender($template);
    });


    checkRoute("PUT", "/admin/users/create", function() {
        modelCall("helpers", "checkLogged");

        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data["username"]) || !isset($data["password"])) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Missing required fields",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        $username = $data["username"];
        $password = $data["password"];

        if (strlen($username) < 3 || strlen($username) > 50) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Username must be at least 3 characters long and not longer than 50 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        //check if not exist
        if (modelCall("users", "getUserId", ["db" => getDatabaseEnvConn("db"), "username" => $username])) {
            http_response_code(409);
            resourceView([
                "code" => 409,
                "message" => "Username already exists",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }
        
        if (strlen($password) < 6) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Password must be at least 6 characters long",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        modelCall("users", "createNewUser", ["db" => getDatabaseEnvConn("db"), "username" => $username, "password" => $password]);

        http_response_code(201);
        resourceView([
            "code" => 201,
            "message" => "User created",
            "time" => date("Y-m-d H:i:s")
        ], "json");
    });
?>
