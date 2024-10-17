<?php

    includes('../includes/functions.php');

    $id = $_GET['id'];

    if(!isset($id))
    {
        header("Location: view_exhibitions.php");
        exit();
    }

    $exhibition = getExhibition($id);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $title = $_POST['title'];
        $artist_id = $_POST['artist_id'];
        $start_date = $_POST['start_date'];
        $end_start = $_POST['end_start'];
        $location = $_POST['location'];
        $description = $_POST['description'];

        if(empty($title)) $error[] = "Title is required.";
        if(empty($artist_id)) $error[] = "Artist is required";
        if(empty($start_date) || empty($end_date)) $error[] = "Start and end dates are required.";
        if($start_date > $end_date) $error[] = "Start date must be before and date.";

        if(empty($error)) {
            updateExhibition($title, $artist_id, $start_date, $end_date, $location, $description, $id);
            echo "Update exhibition successffull!.";

            header("Location:view_exhibitions.php");
        } else {
            $error = "Failed to update exhibition";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Exhibition</title>
        <body>
            <h2>Edit Exihibition</h2>
            <?php if(isset($error)) echo "<p style='color:red;'>$error" ?>
            <form method="post" name="form-exhibition">
                <input type="hidden" name="id" value="<?php echo $exhibition['id'];?>" >

                <div class="form-group">
                    <label for="Artist">Artist</label>
                    <select name="artist_id" value="<?php $exhibition['artist_id'];?>" required>
                        <?php
                            /* Fetch artists */
                            $artists = getArtists();
                            foreach($artists as $artist): ?>
                                <option value="<?php echo $artist['artist_id'];?>"><?php echo $artist['artist_name'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="datetime-locate" name="start_date" value="<?php echo $exhibition['start_date'];?>" required>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="datetime-locate" name="end_date" value="<?php echo $exhibition['end_date'];?>" required>
                </div>

                <div class="form-group">
                    <label for="Location">Location</label>
                    <input type="text" name="location" value="<?php echo $exhibition['location'];?>" >
                </div>

                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea name="description" value="<?php echo $exhibition['description'];?>"></textarea>
                </div>
                <button type="submit" name="update" value="update exhibition">update exhibition</button>
            </form>
            <a href="manage_exhibitions.php"></a>
        </body>
    </head>
</html>