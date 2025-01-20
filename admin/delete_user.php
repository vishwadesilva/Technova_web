<?php
session_start();


include('../includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $stmt = $conn->prepare("DELETE FROM users WHERE id = ? AND role != 'admin'"); 
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage_users.php?success=User+deleted+successfully");
    } else {
        header("Location: manage_users.php?error=Failed+to+delete+user");
    }
} else {
    header("Location: manage_users.php?error=Invalid+user+ID");
}
exit;
