<?php

    include('../includes/functions.php');

    // Initialize error array
    $errors = [];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        /* get the form data */
        $title = $_POST['$title'];
        $artist_id = $_POST['artist_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $location = $_POST['location'];
        $description = $_POST['description'];

        /* Validate inputs */
        if(empty($title)){
            $error[] = "Title is required.";
        }

        if($empty($artist_id)){
            $error[] = "Artist is required.";
        }

        if($empty($start_date) || empty(end_date)){
            $error[] = "Start and end dates are required.";
        }

        if($start_date > $end_date) {
            $error[] = "start date must be before required.";
        }

        if(addExhibition($title, $artist_id, $start_date, $end_date, $location, $description)){
            echo "Add exhibition successfully!.";

            /* redirect to the view exibitions on page after successful insertion */
            header("Location:view_exhibitions.php");
            exit();
        }  else {
            echo "Error adding exhibition.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UFT-8">
        <title>Add Exibition</title>
    </head>
    <body>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="post" name="form-exithition">
            <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label for="artist">Artist:</label>
                <select name="artist_id" class="form-control" required>
                    <?php
                        /* Fetch artists */
                        $artists = getArtists(); 
                        foreach($artists as $artist): ?>
                            <option value="<?php echo $artist['artist_id'];?>"><?php echo $artist['artist_name'];?></option>
                    <?php endforeach: ?>
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="datetime-locate" name="start_date" class="form-control" placeholder="Start Date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="datetime-locate" name="end_date" class="form-group" placeholder="End Date" required>
            </div>
            <div class="form-group">
                <label for="Location">Location </label>
                <input type="text" name="location" class="form-control" placeholder="Location" required>
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="description" class="form-control" placeholder="Description" ></textarea>
            </div>
        </form>
</body>
</html>