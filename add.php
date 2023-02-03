<?php
    include "db_conn.php";

    $add_title = $_POST['add_title']; //from data key pair
    $add_author = $_POST['add_author'];
    $add_date = $_POST['add_date'];
    $add_pub = $_POST['add_pub'];
    $add_genre = $_POST['add_genre'];

    $sql = "INSERT INTO `books`(
        `title`,
        `author`,
        `date_published`,
        `pub`,
        `genre`) VALUES ('$add_title',
        '$add_author',
        '$add_date',
        '$add_pub',
        '$add_genre')";
    
    if(mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }

    mysqli_close($conn);
?>