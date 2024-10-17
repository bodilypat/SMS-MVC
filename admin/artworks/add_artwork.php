<?php

    include 'includes/functions.php';
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('Location:login.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];;
        $artist_id = $_POST['artist_id'];
        $description = $_POST['description'];
        $price = $_POST['price'];

        /* Handle file upload */
        $target_dir = "images/";
        $image_path = '$target_dir/' . basename($_FILES['image']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));

        /* check image file is a valid image */
        $check = getimagesize($_FILES['image']['tmp_name']);

        if($check === false) {
            $_SESSION['message'] = "File is not image";
            $uploadOk = 0;
        }

        /* Check if file already exists */
        if(file_exists($target_file)){
            $_SESSION['message'] = "Sorry, already exists.";
            $uplaodOk = 0;
        }

        /* Check file size(limit to 5MB) */
        if($_FILES['image']['size'] > 500000 ){
            $_SESSION['message'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        /* Allow certain file formats */
        if(!in_array($imageFileType, ['jpg','png','jpeg','gif'])) {
            $_SESSION['message']  = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        /* Check if $uploadOk is set to 0 by an error */
        if($uploadOk === 0){
            header("Location: add_artworks.php");
        } else {
            //IF everything is ok, try to upload the file.

        }

        /* move upload file  */
        if(move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)){

            // Insert artwork into the database
            $artworkId = addArtwork($title, $artist,$description, $price, $image_path);
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