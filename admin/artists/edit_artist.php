<?php

    include 'includes/functions.php';

    if(isset($_GET['id'])){
        $artist_id = $_GET['id'];
    
        $artist = getArtistById($artist_id);

        if(!$artist){
            die("Artist not found.");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $name = $_POST['name'];
            $biography = $_POST['biography'];
            $contact_info = $_POST['phone'];

            if (updateArtist($artist_id, $name, $biography, $contact_info)) {
                echo "Artist updated successfully!";
                /* optionally redirect to another page */
                header('Location: view_artist');
                exit();

            } else {
                echo "Error update artist.";
            }
        } 
    } else {
        echo "No artist ID provided."
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Update Artist</title>
    </head>
    <body>
        <h1>Update Artist</h1>
        <form action="edit_artist.php" method="POST">
            <div class="form-group">
                <label for="name">Name</div>
                <input type="text" name="name" class="form-control" value="<?php $artist['id'];?>"required>
            </div>
            <div class="form-group">
                <label for="biography">Biography</label>
                <textarea name="biography"><?php  $artist['biography']?></textarea>
            </div>
            <div class="form-group">
                <label for="contactno">Phone</label>
                <input type="text" name="contact_info" class="form-control" value="<?php $artist['contact_info'];?>" required>
            </div>
            <button type="text" name="update" value="Update Artist" >Update Artist</button>
        </form>

    </body>
</html>