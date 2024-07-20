<?php
    function getAllCategories($db) {
        $sql = "SELECT id, name, slug FROM categories";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        return $posts;        
    }
?>