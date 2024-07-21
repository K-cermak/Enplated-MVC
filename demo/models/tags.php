<?php
    function getTagsWithCount($db) {
        $sql = "SELECT tags.id, tags.name, tags.slug, COUNT(tag_id) AS tag_count FROM tags LEFT JOIN post_tags ON tags.id = post_tags.tag_id GROUP BY tags.id";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function getTagInfo($db, $slug) {
        $sql = "SELECT tags.id, tags.name, tags.slug, COUNT(tag_id) AS tag_count FROM tags LEFT JOIN post_tags ON tags.id = post_tags.tag_id WHERE tags.slug = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->fetch_assoc();
    }

    function tagExist($db, $tag, $slug) {
        $sql = "SELECT id FROM tags WHERE name = ? OR slug = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $tag, $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->num_rows > 0;
    }

    function idValid($db, $id) {
        $sql = "SELECT id FROM tags WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->num_rows > 0;
    }

    function tagNotUsed($db, $id) {
        $sql = "SELECT tag_id FROM post_tags WHERE tag_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result->num_rows == 0;
    }

    function createTag($db, $tag, $slug) {
        $sql = "INSERT INTO tags (id, name, slug) VALUES (NULL, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $tag, $slug);
        $stmt->execute();
        $stmt->close();
    }

    function renameTag($db, $id, $tag, $slug) {
        $sql = "UPDATE tags SET name = ?, slug = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssi", $tag, $slug, $id);
        $stmt->execute();
        $stmt->close();
    }

    function deleteTag($db, $id) {
        $sql = "DELETE FROM tags WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
?>