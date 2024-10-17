<?php
    include ('../includes/functions.php');

    $id = $_GET['id'] ?? null;

    if($id){
        /* prepare the SQL statment to delete the exhibition */
        $stmt = deleteExhibition($id);

        if($stmt) {
            header("Location:view_exhibitions.php");
            exit();
        } else {
            echo "Error : unable to delete exhibition.";
        }
    }
?>