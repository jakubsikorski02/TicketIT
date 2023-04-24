<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-movie-list.css">
    <title>TicketIT</title>

</head>

<body>
    <div class="container-header">
        <div class="logo">
            <h1><a href="index.php">TicketIT</a></h1>
        </div>
        <div class="about">
            <a href="#"><span class="about-us">About us</span></a>
            <a href="#"><span class="business">Business</span></a>
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
                    echo '<a href="myaccount.php">My account</a>';
                    echo '<a href="#">Settings</a>';
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
    <div class="main-container">
        <?php


        $sql = "SELECT DISTINCT movies.*
        FROM movies
        INNER JOIN schedule ON schedule.movie_id = movies.movie_id
        WHERE schedule.date >= NOW();";


        $result = $conn->query($sql);


        while ($row = $result->fetch_assoc()) {
            echo '<div class="movie-card">';
            echo '<img src="images/'.$row['poster'].'">';
            echo '<div clas="movie-info">';
            echo '<h2>' . $row['title'] . '</h2>';
            echo '<p>Director: ' . $row['director'] . '</p>';
            echo '<p>Year: ' . $row['year'] . '</p>';
            echo '<p>Description: ' . $row['description'] . '</p>';
            echo '<p>Genre: ' . $row['genre'] . '</p>';
            echo '</div>';
            echo '<a href="schedule.php?movieId=' . $row['movie_id'] . '"><button class="select-btn">&#8250;</button></a>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="footer">
        <p>Jakub Sikorski</p>
    </div>

</body>

</html>