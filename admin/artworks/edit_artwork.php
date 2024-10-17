<?php

    include 'include/functions.php';

    if(isset($_GET['id'])){
        $artwork_id = $_GET['id'];
    
        /* Update artworks  */
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = $_POST['title'];
            $artist_id = $_POST['artist_id'];
            $descripton = $_POST['description'];
            $price = $_POST['price'];
            $image_path = $_POST['image_path']

            if(updateArtwork($id, $title, $artist_id, $description, $price, $image_path)){
                echo " Artwork update successfully!";
            } else {
                echo "Error uploading artwork.";
            }
        } else {
            $artwork = getArtwork($artwork_id);
        }
    } else {
        echo "No artwork ID provided.";
    }
?>

<!DOCTYE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Artwork<title>
    </head>
    <body>
        <h1>Edit Artwork</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($artworks['title']);?>" required placeholder="Title">
            </div>
            <div class="form-group">
                <label for="Artist">Artist</label>
                <select  name="artist" value="<?php echo htmlspecialchars($artwork['artist']);?>" required>
                    <?php
                        /* Fetch Artist */
                        <?php
                            $artist = getArtists();
                            foreach ($artists as $artist): ?>
                                <option value="<?php echo $artist['id'];?>"><?php echo  htmlspecialchars($artist['artist_name']);?></option>
                        <?php endforeach; ?>
                </select>
            </div>
            </div>
            <div class="form-group">
                <label for="Price">Price</label>
                <input type="number" name="price" value="<?php echo htmlspecialchars($artwork['price']);?>" required >
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="description"><?php echo htmlspecialchars($artwork['description']);?></textarea>
            </div>
            <div class="form-group">
                <label for="Image">Image</label>
                <input type="file" name="image" value="<?php echo $artwork['image_path'];?>" >
            </div>
            <button type="submit">Update Artwork</button>
        </form>
    </body>
</html>