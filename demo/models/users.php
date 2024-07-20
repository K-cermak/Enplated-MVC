<?php
    function getUserId($db, $username) {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows == 0) {
            return null;
        }

        return $result->fetch_assoc()["id"];
    }

    function getUsername($db, $id) {
        $sql = "SELECT username FROM users WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows == 0) {
            return null;
        }

        return $result->fetch_assoc()["username"];
    }

    function checkPassword($db, $id, $password) {
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return password_verify($password, $result->fetch_assoc()["password"]);
    }

    
    function changeUsername($db, $id, $newUsername) {
        $sql = "UPDATE users SET username = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("si", $newUsername, $id);
        $stmt->execute();
        $stmt->close();
    }

    function changePassword($db, $id, $newPassword) {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("si", $hashed, $id);
        $stmt->execute();
        $stmt->close();
    }

    
    function createNewUser($db, $username, $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users VALUES (NULL, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $username, $hashed);
        $stmt->execute();
        $stmt->close();
    }

    function getUsersWithPostNum($db) {
        $sql = "SELECT users.id, users.username, COUNT(posts.id) as postNum FROM users LEFT JOIN posts ON users.id = posts.author GROUP BY users.id ORDER BY users.username";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

?>