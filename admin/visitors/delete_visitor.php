<?php

    include('../includes/functions.php');

    if(isset($_GET['id'])) {
        $visitor_id = $_GET['id'];

        /* Fetch vistors to confirm delete */
        $vistor = getVisitor($visitor_id);
        if(!$artist){
            die("Artist not found");
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
            if(deleteVisitor($visitor_id)) {
                echo "Visitor deleted successfull!";
                /* Optionally redirect to anthor page */
                header("Location: view_visitor");
                exit();
            } else {
                echo "Error deleting artist.";
            }
        }
    } else { 
        echo "No visitor ID provided.";
    }
?>

