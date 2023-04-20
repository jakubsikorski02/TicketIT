<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-register.css">
    <title>Document</title>
</head>

<body>
    <div class="container-register">
        <form class="form" method="POST">
            <div class="input">
                <p class="name">Email</p>
                <input type="text" name="email" required>
            </div>
            <div class="input">
                <p class="name">Login</p>
                <input type="text" name="login" required>
            </div>
            <div class="input">
                <p class="name">Password</p>
                <input type="password" name="password" required>
            </div>
            <div class="register">
                <button class="register-btn" type="submit" name="submit">Utwórz konto</button>
            </div>
            <div class="already-have">
                <span class="login-btn" name="alreadyHave">Already have an account? <a href="login.php">Log
                        in</a></span>
            </div>
        </form>

        <?php

        include('dbconnection.php');


        if (isset($_POST['submit'])) {

            $email = $_POST['email'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $role = 0;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format.";
                return;
            } else {

                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $conn->prepare("INSERT INTO users (email, login, password, role) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssi", $email, $login, $password_hash, $role);
                if ($stmt->execute()) {
                    echo "User account created successfully.";
                    header("refresh:3;url=login.php");
                    exit;
                } else {
                    echo "Error creating user account: " . $stmt->error;
                }
            }
        }
        ?>

    </div>
</body>

</html>