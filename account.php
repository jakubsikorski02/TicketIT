<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketIT</title>
</head>

<body>
    <?php
    include('myaccount.php');
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    ?>
    <?php
    echo '<div class="main-content">';
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT login, email FROM users WHERE id = $user_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $login = $row['login'];
    $email = $row['email'];
    echo '<div class="account">';
    echo '<h2>Profile</h2>';
    echo 'e-mail: ' . $email . '</br>';
    echo 'login: ' . $login;
    echo '</div>';
    ?>
    </div>
</body>

</html>