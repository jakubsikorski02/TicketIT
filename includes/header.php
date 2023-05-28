<div class="container-header">
    <div class="logo">
        <h1><a href="index.php">TicketIT</a></h1>
    </div>
    <div class="about">
        <a href="aboutus.php" class="about-us">About us</a>
        <?php
        session_start();
        include("dbconnection.php");
        if (isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
            if($_SESSION["userRole"] === 0){
                
                }
                elseif($_SESSION["userRole"] === 1)
                {
                    echo '<a href="employee.php" class="Managment">Management</a>';
                }
                elseif($_SESSION["userRole"] === 2){
                    echo '<a href="manager.php" class="management">Management</a>';
                }
            echo '<a href="movie-list.php" class="movies">Movies</a>';
            echo '</div>';
            echo '<div class="profile-menu">';
            $sql0 = "SELECT user_image FROM users WHERE id = $userId";
            $result0 = $conn->query($sql0);
            $row0 = $result0->fetch_assoc();
            $imageSrc = $row0["user_image"];
            if (empty($imageSrc)) {
                echo '<img src="images/profile.png" class="profile-menu-img">';
            } else {
                echo '<img src="' . $imageSrc . '" class="profile-menu-img">';
            }
            echo '<div class="profile-menu-dropdown">';
            echo '<a href="mybookings.php">My bookings</a>';
            echo '<a href="settings.php">Settings</a>';
            echo '<a href="logout.php"><span>Log out</span></a>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<a href="movie-list.php" class="movies">Movies</a>';
            echo '</div>';
            echo '<div class="profile-menu">';
            echo '<img src="images/profile.png" class="profile-menu-img">';
            echo '<div class="profile-menu-dropdown">';
            echo '<a href="login.php"><span>Log in</span></a>';
        }
        ?>
    </div>
</div>
</div>