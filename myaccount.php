<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-myaccount.css">
    <title>TicketIT</title>

</head>

<body>
    <div class="container-header">
        <div class="logo">
            <h1><a href="index.php">TicketIT</a></h1>
        </div>
        <div class="about">
            <a href="#"><span>About us</span></a>
            <a href="#"><span>Business</span></a>
            <?php
            session_start();
            if (isset($_SESSION['user_id'])) {

                echo '<a href="movie-list.php"><span>Movies</span></a>';
            } else {
                echo '<a href="login.php"><span>Movies</span</a>';
            }

            echo '</div>';
            echo '<div class="profile-menu">';
            echo '   <img src="images/profile.png" class="profile-menu-img">';
            echo '<div class="profile-menu-dropdown">';

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                echo '<a href="myaccount.php">My account</a>';
                echo '<a href="#">Settings</a>';
                echo '<a href="index.php?action=logout"><span>Log out</span></a>';
            } else {
                echo '<a href="login.php"><span>Log in</span></a>';
            }

            if (isset($_GET['action']) && $_GET['action'] == "logout") {

                unset($_SESSION['user_id']);

                header("Location: index.php");

            }


            ?>
        </div>
    </div>
    </div>
    <div class="body-container">
        <?php
        include('dbconnection.php');
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
</body>

</html>