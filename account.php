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
    include("includes/header.php");
    ?>

    <div class="main-container">
        <?php
        if (!isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            header("Location: login.php");
            exit();
        }

        echo '<div class="nav-container">';
        echo '<nav>';
        echo '<a href="account.php">Profile</a>';
        echo '<a href="currentbookings.php">Current bookings</a>';
        echo '</nav>';
        echo '</div>';

        ?>
    <?php
    echo '<div class="user-container">';
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
    </div>
    <div class="footer">
        <p>Jakub Sikorski</p>
    </div>
</body>

</html>