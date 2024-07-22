<?php
    checkRoute("GET", "/admin/posts", function() {
        modelCall("helpers", "checkLogged");
        
        $posts = modelCall("posts", "getPosts", [getDatabaseEnvConn("db")]);
        $template = processTemplate("admin/posts", ["title" => "Posts", "posts" => $posts]);
        finishRender($template);
    });


    checkRoute("GET", "/admin/posts/create", function() {
        modelCall("helpers", "checkLogged");

        $tags = modelCall("tags", "getTagsWithCount", [getDatabaseEnvConn("db")]);
        $template = processTemplate("admin/posts-create", ["title" => "Posts", "tags" => $tags]);
        finishRender($template);
    });


    checkRoute("GET", "/admin/posts/edit/{slug}", function() {
        modelCall("helpers", "checkLogged");

        $slug = getRequestParam("slug");
        //check if exist
        $post = modelCall("posts", "getPostBySlug", [getDatabaseEnvConn("db"), $slug]);
        if (!$post) {
            unset($_ENV["REQUEST"]["FOUND"]);
            require_once "engine/errors/404.php";
            die();
        }

        //if post author is not the logged user
        if ($post["author"] != $_SESSION["loggedId"]) {
            require_once "engine/errors/403.php";
            die();
        }

        $tags = modelCall("tags", "getTagsWithCount", [getDatabaseEnvConn("db")]);
        $assignedTags = modelCall("posts", "getTagsByPost", [getDatabaseEnvConn("db"), $post["id"]]);
        $assignedTags = array_map(function($tag) {
            return $tag["id"];
        }, $assignedTags);

        $template = processTemplate("admin/posts-edit", ["title" => "Posts", "post" => $post, "tags" => $tags, "assignedTags" => $assignedTags]);
        finishRender($template);
    });

    
    checkRoute("GET", "/admin/posts/delete/{slug}", function() {
        modelCall("helpers", "checkLogged");

        $slug = getRequestParam("slug");
        $post = modelCall("posts", "getPostBySlug", [getDatabaseEnvConn("db"), $slug]);

        if (empty($post["title"])) {
            unset($_ENV["REQUEST"]["FOUND"]);
            require_once "engine/errors/404.php";
            die();
        }

        if ($post["author"] != $_SESSION["loggedId"]) {
            require_once "engine/errors/403.php";
            die();
        }

        $template = processTemplate("admin/posts-delete", ["title" => "Delete post", "post" => $post]);
        finishRender($template);
    });


    checkRoute("PUT", "/admin/posts/create", function() {
        modelCall("helpers", "checkLogged");

        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data["title"]) || !isset($data["slug"]) || !isset($data["text"])) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Missing required fields",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        $title = $data["title"];
        $slug = $data["slug"];
        $text = $data["text"];
        $tags = isset($data['tags']) ? $data['tags'] : [];

        //title between 5 and 70 characters
        if (strlen($title) < 5 || strlen($title) > 70) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Title must be between 5 and 70 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        //slug between 5 and 50 characters
        if (strlen($slug) < 5 || strlen($slug) > 50) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Slug must be between 5 and 50 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        //slug is unique
        $post = modelCall("posts", "getPostBySlug", [getDatabaseEnvConn("db"), $slug]);
        if ($post) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Slug must be unique",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        //save post
        $post = modelCall("posts", "createPost", [getDatabaseEnvConn("db"), $title, $slug, $text, $_SESSION["loggedId"]]);
        if (!$post) {
            http_response_code(500);
            resourceView([
                "code" => 500,
                "message" => "Error creating post",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        //save tags
        foreach ($tags as $tag) {
            modelCall("posts", "assignTag", [getDatabaseEnvConn("db"), $tag, $post["id"]]);
        }

        http_response_code(201);
        resourceView([
            "code" => 201,
            "message" => "Post created",
            "time" => date("Y-m-d H:i:s")
        ], "json");

    });


    checkRoute("PATCH", "/admin/posts/edit", function() {
        modelCall("helpers", "checkLogged");

        $slug = getRequestParam("slug");
        //check if exist
        $post = modelCall("posts", "getPostBySlug", [getDatabaseEnvConn("db"), $slug]);
        if (!$post) {
            
        }

        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data["title"]) || !isset($data["slug"]) || !isset($data["text"]) || !isset($data["id"])) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Missing required fields",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        $title = $data["title"];
        $slug = $data["slug"];
        $text = $data["text"];
        $tags = isset($data['tags']) ? $data['tags'] : [];
        $id = $data["id"];

        //title between 5 and 70 characters
        if (strlen($title) < 5 || strlen($title) > 70) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Title must be between 5 and 70 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        //slug between 5 and 50 characters
        if (strlen($slug) < 5 || strlen($slug) > 50) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Slug must be between 5 and 50 characters",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        //id is correct
        $post = modelCall("posts", "getPostById", [getDatabaseEnvConn("db"), $id]);
        if (!$post) {
            http_response_code(400);
            
            resourceView([
                "code" => 400,
                "message" => "Post not found",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        if ($post["author"] != $_SESSION["loggedId"]) {
            http_response_code(403);
            resourceView([
                "code" => 403,
                "message" => "You are not the author of this post",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }


        //slug is unique
        $post = modelCall("posts", "getPostBySlug", [getDatabaseEnvConn("db"), $slug]);
        if ($post && $post["id"] != $id) {
            http_response_code(400);
            resourceView([
                "code" => 400,
                "message" => "Slug must be unique",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        modelCall("posts", "updatePost", [getDatabaseEnvConn("db"), $title, $slug, $text, $id]);
        
        modelCall("posts", "resetTags", [getDatabaseEnvConn("db"), $id]);

        foreach ($tags as $tag) {
            modelCall("posts", "assignTag", [getDatabaseEnvConn("db"), $tag, $id]);
        }

        http_response_code(200);
        resourceView([
            "code" => 200,
            "message" => "Post updated",
            "time" => date("Y-m-d H:i:s"),
            "redirect" => getAppEnvVar("BASE_URL") . "/admin/posts/edit/" . $slug
        ], "json");
    });

    
    checkRoute("DELETE", "/admin/posts", function() {
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
        $post = modelCall("posts", "getPostById", [getDatabaseEnvConn("db"), $id]);

        if (empty($post["title"])) {
            http_response_code(404);
            resourceView([
                "code" => 404,
                "message" => "Post not found",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        if ($post["author"] != $_SESSION["loggedId"]) {
            http_response_code(403);
            resourceView([
                "code" => 403,
                "message" => "You are not the author of this post",
                "time" => date("Y-m-d H:i:s")
            ], "json");
        }

        modelCall("posts", "resetTags", [getDatabaseEnvConn("db"), $post["id"]]);
        modelCall("posts", "deletePost", [getDatabaseEnvConn("db"), $post["id"]]);

        http_response_code(200);
        resourceView([
            "code" => 200,
            "message" => "Post deleted",
            "time" => date("Y-m-d H:i:s"),
            "redirect" => getAppEnvVar("BASE_URL") . "/admin/posts"
        ], "json");
    });
?>