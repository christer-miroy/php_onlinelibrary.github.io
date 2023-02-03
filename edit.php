<?php
    include "db_conn.php";

    $edit_id = $_POST['edit_id'];
    $edit_title = $_POST['edit_title'];
    $edit_author = $_POST['edit_author'];
    $edit_date = $_POST['edit_date'];
    $edit_pub = $_POST['edit_pub'];
    $edit_genre = $_POST['edit_genre'];

    $sql = "UPDATE `books` SET
    `title`='$edit_title',
    `author`='$edit_author',
    `date_published`='$edit_date',
    `pub`='$edit_pub',
    `genre`='$edit_genre' WHERE `id` = '$edit_id'";

    if(mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }

    mysqli_close($conn);
?>