<?php

    include('../includes/functions.php');

    if(isset($_GET['exhibition_id'])){
        $exhibition_id = $_GET['exhibition_id'];
        $exArtworks = getArtworksForExhibition($exhibition_id);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $artwork_id = $_POST['artwork_id'];
            if(removeArtworkFromExhibition($exhibition_id, $artwork_id)) {
                echo "Artwork removed from exhibition successfully!";
            } else {
                echo "Error removing artwork form exhibition.";
            }
        }
    } else {
        die("No exhibition ID provided")
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Remove Artwork from Exhibition</title>
    </head>
    <body>
        <h1>Remove Artwork from Exhibition</h1>
        <form action="remove_artwork_from_exhibiton.php?exhhibiton_id=<?php echo $exhibition_id; ?>" method="post">
            <div class="form-group">
                <label for="artwork_id">Select Artwork to Remove: </label>
                <select name="artwork_id" required>
                    <?php foreach($exArtworks as $artwork): ?>
                        <option value="<?php echo $artwork['id'];?>"><?php echo htmlspecialchars($artwork['title']);?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="remove_artwork" value="Remove Artwork">
        </form>
    </body>
</html>