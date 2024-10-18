<?php

    includes('../includes/functions.php');

    /* Fetch the visitor details your database connection */
    session_start();

    if($isse($_GET['id'])){
        $id = (int)$_GET['id'];
        $visitor = getVistorById($id);

        if(!visitor) {
            die("Visitor not found");
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $feedback = $_POST['feedback'];

            /* Insert vistor data into database */
            if(updateArtist($name, $email, $phone, $feedback )){

                echo "visitor update successfully!";
                /* optionally redirect to another page */
                header("Location: view_visitor");
                exit();
            } else {
                echo "Error update visitor";
            }
        }
    } else {
        echo " No visitor ID provided."
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Update Artist</title>
    </head>
    <body>
        <h1>Update Visition</h1>
        <form action="edit_visitor.php" method="post">
            <div class="form-group">
                <label for="Name">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $visitor['name'];?>" required>
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $visitor['email'];?>" required>
            </div>
            <div class="form-group">
                <label for="Phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $visitor['phone'];?>" required>
            </div>
            <div class="form-group">
                <label for="Feedback">Feedback</label>
                <textarea name="feedback" class="form-control" value="<?php echo $vistor['feedback'];?>"></textarea>
            </div>
            <button type="submit" name="feedback" value="feedback">Edit Visitor</button>
        </form>
    </body>
</html>