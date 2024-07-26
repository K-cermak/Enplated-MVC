<?php
    checkRoute('GET', '/', function() {
        $tags = modelCall("tags", "getTagsWithCount", [getDatabaseEnvConn("db")]);
        $posts = modelCall("posts", "getPosts", [getDatabaseEnvConn("db")]); 

        $template = processTemplate('index', ["title" => "Home", "tags" => $tags, "posts" => $posts]);
        finishRender($template);
    });

    checkRoute('GET', '/tag/{slug}', function() {
        $slug = getRequestParam("slug");

        $tag = modelCall("tags", "getTagInfo", [getDatabaseEnvConn("db"), $slug]);
        if ($tag["id"] == null) {
            unset($_ENV["REQUEST"]["FOUND"]);
            require_once "engine/errors/404.php";
            die();
        }

        $tags = modelCall("tags", "getTagsWithCount", [getDatabaseEnvConn("db")]);
        $posts = modelCall("posts", "getPostsByTag", [getDatabaseEnvConn("db"), $tag["id"]]);

        $template = processTemplate('tags', ["title" => $tag["name"], "tag_name" => $tag["name"], "tags" => $tags, "posts" => $posts]);
        finishRender($template);
    });

    checkRoute('GET', '/post/{slug}', function() {
        $slug = getRequestParam("slug");

        $tags = modelCall("tags", "getTagsWithCount", [getDatabaseEnvConn("db")]);
        $post = modelCall("posts", "getPostBySlug", [getDatabaseEnvConn("db"), $slug]);
        if (!$post) {
            unset($_ENV["REQUEST"]["FOUND"]);
            require_once "engine/errors/404.php";
            die();
        }

        $usedTags = modelCall("posts", "getTagsByPost", [getDatabaseEnvConn("db"), $post["id"]]);
        $username = modelCall("users", "getUsername", [getDatabaseEnvConn("db"), $post["author"]]);

        $template = processTemplate('post', ["title" => $post["title"], "tags" => $tags, "post" => $post, "usedTags" => $usedTags, "username" => $username]);
        finishRender($template);
    });
?>