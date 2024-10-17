<?php

    include('../includes/functions.pph');

    if(isset($_GET['exhibition_id'])){
        $exhibition_id = $_GET['exhibition_id'];

        /* Fetch all artworks to select from */
        $artworks = getArtworks();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $artwork_id = $_POST['artwork_id'];
            if(addArtworkToExhibition($exhibition_id, $artwork_id)){
                echo "Artwork added to exhibition successffully!.";
            } else {
                echo "Error adding artwork to exhibition.";
            }
        }
    } else {
        die('No exhibition ID provided.');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Artwork to Exhibitons</title>
    </head>
    <body>
        <h1>Add Artwork to Exhibition</h1>
        <form action="add_artwork_to_exhibiton.php?exhibition_id =<?pho echo $exhibition_id; ?>" method="post">
            <div class="form-grouup">
                <label for="Artwork">Select Artwork:</label>
                <select name="artwork_id" required>
                    <!-- Fetch artworks data -->
                    <?php foreach($artworks as $artwork): ?>
                        <option value="<?php echo $artwork['id'];?>"><?php echo $artwork['artwork_name'];?></option>
                    <?php endforeach: ?>
                </select>
            </div>
            <button type="submit" name="add" value="add artwork to exhibiton">Add ArtworkToExhibition</button>
        </form>
    </body>
</html>
