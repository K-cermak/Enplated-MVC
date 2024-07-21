<?php
    checkRoute("GET", "/admin/tags", function() {
        modelCall("helpers", "checkLogged");
        $tags = modelCall("tags", "getTagsWithCount", [getDatabaseEnvConn("db")]);
        $template = processTemplate("admin/tags", ["title" => "Tags", "tags" => $tags]);
        finishRender($template);
    });

    
    checkRoute("GET", "/admin/tags/rename/{slug}", function() {
        modelCall("helpers", "checkLogged");

        $slug = getRequestParam("slug");
        $tag = modelCall("tags", "getTagInfo", [getDatabaseEnvConn("db"), $slug]);

        if (empty($tag["name"])) {
            unset($_ENV["REQUEST"]["FOUND"]);
            require_once "engine/errors/404.php";
            die();
        }

        $template = processTemplate("admin/tags-rename", ["title" => "Rename tag", "tag" => $tag]);
        finishRender($template);
    });


    checkRoute("GET", "/admin/tags/delete/{slug}", function() {
        modelCall("helpers", "checkLogged");

        $slug = getRequestParam("slug");
        $tag = modelCall("tags", "getTagInfo", [getDatabaseEnvConn("db"), $slug]);

        if (empty($tag["name"])) {
            unset($_ENV["REQUEST"]["FOUND"]);
            require_once "engine/errors/404.php";
            die();
        }

        $template = processTemplate("admin/tags-delete", ["title" => "Delete tag", "tag" => $tag]);
        finishRender($template);
    });


    checkRoute("PUT", "/admin/tags", function() { //CREATE
        modelCall("helpers", "checkLogged");

        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data["tagname"]) || !isset($data["slug"])) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Missing required fields",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        $tagname = $data["tagname"];
        $slug = $data["slug"];

        if (strlen($tagname) < 2 || strlen($tagname) > 70) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Tag name must be at least 2 characters long and not longer than 70 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        if (strlen($slug) < 2 || strlen($slug) > 50) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Slug must be at least 2 characters long and not longer than 50 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        if (modelCall("tags", "tagExist", [getDatabaseEnvConn("db"), $tagname, $slug])) {
            http_response_code(409);
            resourceView([
                "code" => 409,
                "message" => "Tag already exists",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        modelCall("tags", "createTag", [getDatabaseEnvConn("db"), $tagname, $slug]);
        resourceView([
            "code" => 201,
            "message" => "Tag created",
            "time" => date("Y-m-d H:i:s")
        ], "json");
    });


    checkRoute("PATCH", "/admin/tags", function() { //RENAME
        modelCall("helpers", "checkLogged");

        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data["tagname"]) || !isset($data["slug"]) || !isset($data["id"])) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Missing required fields",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        $tagname = $data["tagname"];
        $slug = $data["slug"];
        $id = $data["id"];

        if (strlen($tagname) < 2 || strlen($tagname) > 70) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Tag name must be at least 2 characters long and not longer than 70 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        if (strlen($slug) < 2 || strlen($slug) > 50) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Slug must be at least 2 characters long and not longer than 50 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        if (!modelCall("tags", "idValid", [getDatabaseEnvConn("db"), $id])) {
            http_response_code(409);
            resourceView([
                "code" => 409,
                "message" => "Tag already exists",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }


        modelCall("tags", "renameTag", [getDatabaseEnvConn("db"), $id, $tagname, $slug]);
        resourceView([
            "code" => 200,
            "message" => "Tag renamed",
            "time" => date("Y-m-d H:i:s")
        ], "json");
    });


    checkRoute("DELETE", "/admin/tags", function() { //DELETE
        modelCall("helpers", "checkLogged");

        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data["id"])) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Missing required fields",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        $id = $data["id"];
        if (!modelCall("tags", "idValid", [getDatabaseEnvConn("db"), $id])) {
            http_response_code(409);
            resourceView([
                "code" => 409,
                "message" => "Tag does not exist",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        if (!modelCall("tags", "tagNotUsed", [getDatabaseEnvConn("db"), $id])) {
            http_response_code(409);
            resourceView([
                "code" => 409,
                "message" => "Tag is in use",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        modelCall("tags", "deleteTag", [getDatabaseEnvConn("db"), $id]);
        resourceView([
            "code" => 200,
            "message" => "Tag deleted",
            "time" => date("Y-m-d H:i:s")
        ], "json");
    });
?>