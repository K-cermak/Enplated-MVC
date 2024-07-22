<?php
    function getPosts($db) {
        $sql = "SELECT *, users.username AS author_name FROM posts JOIN users ON posts.author = users.id ORDER BY created_at DESC";
        $result = $db->query($sql);
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        return $posts;
    }

    function getPostsByTag($db, $tagId) {
        $sql = "SELECT posts.*, users.username AS author_name FROM posts JOIN post_tags ON posts.id = post_tags.post_id JOIN users ON posts.author = users.id WHERE post_tags.tag_id = ? ORDER BY created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $tagId);
        $stmt->execute();
        $result = $stmt->get_result();
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        return $posts;
    }

    function getPostBySlug($db, $slug) {
        $sql = "SELECT * FROM posts WHERE slug = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();
        return $post;
    }

    function getPostById($db, $id) {
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $post = $result->fetch_assoc();
        return $post;
    }

    function createPost($db, $title, $slug, $text, $author) {
        $sql = "INSERT INTO posts (id, title, slug, text, created_at, updated_at, author) VALUES (NULL, ?, ?, ?, NOW(), NOW(), ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssi", $title, $slug, $text, $author);
        $stmt->execute();
        $post = getPostBySlug($db, $slug);
        return $post;
    }

    function updatePost($db, $title, $slug, $text, $postId) {
        $sql = "UPDATE posts SET title = ?, slug = ?, text = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sssi", $title, $slug, $text, $postId);
        $stmt->execute();
    }

    function deletePost($db, $postId) {
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
    }

    function getTagsByPost($db, $postId) {
        $sql = "SELECT tags.id, tags.slug, tags.name FROM post_tags JOIN tags ON post_tags.tag_id = tags.id WHERE post_tags.post_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
        $result = $stmt->get_result();
        $tags = $result->fetch_all(MYSQLI_ASSOC);
        return $tags;
    }

    function assignTag($db, $tag, $post) {
        $sql = "INSERT INTO post_tags (post_id, tag_id) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ii", $post, $tag);
        $stmt->execute();
    }

    function resetTags($db, $postId) {
        $sql = "DELETE FROM post_tags WHERE post_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $postId);
        $stmt->execute();
    }
?>