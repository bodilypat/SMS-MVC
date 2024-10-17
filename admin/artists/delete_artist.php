<?php
    include '../includes/functions.php';

    if(isset($_GET['id'])){
        $artist_id = $_GET['id'];

        /* Fetch artists to confirm deletion */
        $artist = getArtistById($artist_id);
        if(!$artist){
            die("Artist not dound.");
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])){
            if(deleteArtist($artist_id)){
                echo "Artist deleted successfull!";
                /* Optionally redirect to anthor page */
                header("Location:view_artists.php");
                exit();
            } else {
                echo "Error deleting artist.";
            }
        }
    } else {
        echo "No artist ID provided.";
    }
?>
