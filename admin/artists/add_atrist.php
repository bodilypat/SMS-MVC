<?php

    include 'includes/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $biography = $_POST['biography'];
        $connect_info = $_POST['contact_info'];

        if (addArtist($name, $biography, $connect_info)) {

            echo "Artist added successfull!";
            header('Location:view_artists.php');
        } else {
            echo "Failed to add artist.";
        }
    }
?>
<!DOCTYPE html>
<html lang="e">
    <head>
        <meta charset="UTF-8">
        <title>Add Artist</title>
    </head>
    <body>
        <form action="add_artist.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Artist Name" required>
            </div>
            <div class="form-group">
                <label for="Biography"></label>
                <textarea name="biography" class="form-control" placeholder="Biography" ></textarea>
            </div>
            <div class="form-group">
                <label for="Contact_info">Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <button type="submit" name="add" value="add artist">Add Artist</button>
        </form>
    </body>
</html>