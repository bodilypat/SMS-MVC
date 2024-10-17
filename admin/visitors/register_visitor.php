<?php

    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $feedback = $_POST['feedback'];

        /* Insert visitor data into database */
        $lastID = addVistor($name, $email, $phone, $address, $feedback);
        if($lastID){
            $_SESSION['message'] = "Thank tou for feedback!";
        } else {
            $_SESSION['message'] = "Error submitting feedback.";
        }
        header("location:view_visitor.php");
        exit();

    }

?>

<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTR-8">
        <title>Visitor Registration</title>
    </head>
    <body>
        <h1>Visitor Registration</h1>
        <?php if($isset($_SESSION['message'])); ?>
            <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
        <?php endif; ?>
        <form action="add_visitor.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" class="form-control" placeholder="Address" ></textarea>
            </div>
            <div class="form-group">
                <label for="FeedBack">FeedBack</label>
                <textarea name="feedback" class="form-control"></textarea>
            </div>
        </form>
        <a href="view_gallerys.php">Back to Gallery</a>
    </body>
</html>