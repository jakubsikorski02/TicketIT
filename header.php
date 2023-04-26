<div class="container-header">
        <div class="logo">
            <h1><a href="index.php">TicketIT</a></h1>
        </div>
        <div class="about">
            <a href="aboutus.php"><span class="about-us">About us</span></a>
            <?php
            session_start();
            include("dbconnection.php");
            if (isset($_SESSION['user_id'])) {

                echo '<a href="movie-list.php"><span class="movies">Movies</span></a>';
            } else {
                echo '<a href="login.php"><span class="movies">Movies</span></a>';
            }
            ?>
        </div>
        <div class="profile-menu">
            <img src="images/profile.png" class="profile-menu-img">
            <div class="profile-menu-dropdown">
                <?php
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    echo '<a href="mybookings.php">My bookings</a>';
                    echo '<a href="settings.php">Settings</a>';
                    echo '<a href="index.php?action=logout"><span>Log out</span></a>';
                } else {
                    echo '<a href="login.php"><span>Log in</span></a>';
                }

                if (isset($_GET['action']) && $_GET['action'] == "logout") {
                    unset($_SESSION['user_id']);
                    header("Location: index.php");
                    exit;
                }
                ?>
            </div>
        </div>
    </div>