<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-settings.css">
    <title>TicketIT</title>
</head>

<body>
    <?php
    include("header.php");
    ?>
    <div class="main-container">
        <?php
        include("settingsnav.php");
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT login, email FROM users WHERE id = $user_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $login = $row['login'];
        $email = $row['email'];
        echo '<div class="account">';
        echo '<h2>Account details</h2>';
        echo 'e-mail: ' . $email . '</br>';
        echo 'login: ' . $login;
        echo '</div>';
        ?>

    </div>
    <div class="footer">
        <p>Jakub Sikorski</p>
    </div>
</body>

</html>