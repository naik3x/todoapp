<?php

if (isset($_POST['title'])) {
    require '../db_conn.php';

    $title = $_POST['title'];
    // $description = $_POST['description'];

    if (empty($title)){
        header("Location: ../index.php?mess=error");
    } else {
        $stmt = $conn->prepare("INSERT INTO todos(title) VALUES(?)");
        $res = $stmt->execute([$title]);
        // $stmt2 = $conn->prepare("INSERT INTO todos(description) where todos(title) VALUES(?)");
        // $res2 = $stmt2->execute([$description]);

        if ($res) {
            header("Location: ../index.php?mess=success");
        }
        
        else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
} else {
    header("Location: ../index.php?mess=error");
}