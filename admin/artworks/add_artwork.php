<?php

    include 'includes/functions.php';

    if(!isset($_SESSION['user_id'])){
        header('Location:login.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];;
        $artist_id = $_POST['artist_id'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image_path = 'images/' . basename($_FILES['image']['name']);

        /* move upload file  */
        if(move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)){

            $artworkId = addArtwork($title, $arttis,$description, $price, $image_path);
            echo "Artwork added successfully with ID: $artworkId";
            header('Location:manage_artworks.php');

        } else {

            echo "Failed to adding artwork.";
        }        
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Artwork</title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" name="title" class="form-control"  placehoder="Title" required>
            </div>
            <div class="form-group">
                <label for="artist">Artist</label>
                <select name="artist_id"  placehodler="Artist" required>
                    <?php 
                        /* Fetch artist */
                        $artists = getArtists();
                        foreach($artists as $artist): ?>
                            <option value="<?php echo $artist['id'];?>"><?php echo $artist['artist_id'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textare  name="description" class="form-control" placeholder="Description" required></textarea>
            </div>
            <div class="form-group">
                <label for="Price">Price</label>
                <input type="number" name="price" class="form-control" placeholder="Price">
            </div>
            <div class="form-group">
                <label for="Image">Image </label>
                <input type="file" name="image_path" placeholder="Image" required>
            </div>
            <button type="submit" name="add" value="add Artwork">Add Artwork/button>
        </form>
    </body>
</html>