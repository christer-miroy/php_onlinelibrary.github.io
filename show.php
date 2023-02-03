<!-- sql -->
<?php
    include "db_conn.php";

    //select all from database
    $sql = "SELECT * from `books`";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            //id, title, author, date_published, pub, genre
?>
    <tr>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['author']; ?></td>
        <td><?php echo $row['date_published']; ?></td>
        <td><?php echo $row['pub']; ?></td>
        <td><?php echo $row['genre']; ?></td>
        <td>
            <button class="btn btn-primary"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#view_modal"
                data-id="<?=$row['id']; ?>"
                data-title="<?=$row['title']; ?>"
                data-author="<?=$row['author']; ?>"
                data-date="<?=$row['date_published']; ?>"
                data-pub="<?=$row['pub']; ?>"
                data-genre="<?=$row['genre']; ?>">View
            </button>

            <button class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#edit_modal"
                data-id="<?=$row['id']; ?>"
                data-title="<?=$row['title']; ?>"
                data-author="<?=$row['author']; ?>"
                data-date="<?=$row['date_published']; ?>"
                data-pub="<?=$row['pub']; ?>"
                data-genre="<?=$row['genre']; ?>"
                type="button">Edit
            </button>

            <button class="btn btn-danger"
                id="delete"
                data-id="<?=$row['id']; ?>">Delete
            </button>
        </td>
    </tr>
<?php            
        }
    } else {
        echo "<tr><td>No result found.</td></tr>";
    }
    $mysqli_close($conn);
?>