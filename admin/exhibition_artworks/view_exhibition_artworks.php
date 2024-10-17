<?php

    include('../includes/functions.php');

    if(isset($_GET['exhibition_id'])) {
        $exhibition_id = $_GET['exhibition_id'];

        /* Fetch all artworks  */
        $exArtworks = getArtworkForExhibition($exhibition_id);
    } else {
        die("NO exhibition ID provided.")
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Exhibiton Artworks</title>
    </head>
    <body>
        <ul>
            <?php foreach($exArtworks as $artwork): ?>
                <li><?php echo htmlspecialchars($artwork['title']);?></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>