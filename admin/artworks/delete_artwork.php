<?php

    include 'includes/function.php';

    if(isset($_GET['id'])){
        $artwork_id = $_GET['id'];

        /* Fetch artworks display before deletion */
        $artwork = getArtwork($artwork_id);

        if(!$artwork) {
            die("Artwork not found.");
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
            if(deleteArtwork($artwork_id)) {
                echo "Artwork  delete successfully.";
            } else {
                echo "Error deleting artwork.";
            }
        }
    } else {
        echo "No artwork ID provided.";
    }
?>


