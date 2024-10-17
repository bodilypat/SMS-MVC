<?php

    session_start();
    include('includes/functions.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM  users WHERE usename = '$usermame' ");
        $stmt->bindParam('username=>'$username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header('Location:gallery.php');
        } else {
            $error = "Invalid credentials";
        }
    }
?>
<!DOCTYE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" required placeholder="Usernmae">
        <input type="password" name="password" required placeholder="Password">
        <button type="submit">Login</button>
    </form>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>

