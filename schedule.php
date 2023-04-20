<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style-schedule.css">
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
            include('dbconnection.php');
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
    <div class="schedule-container">
        <h1>Choose date</h1>
        <?php
        $movieId = $_GET['movieId'];

        $sql = "SELECT * FROM movies WHERE movie_id= $movieId";
        $result = $conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="selected-movie">';
            echo '<h2>' . $row['title'] . '</h2>';
            echo '<p>Director: ' . $row['director'] . '</p>';
            echo '<p>Year: ' . $row['year'] . '</p>';
            echo '<p>Description: ' . $row['description'] . '</p>';
            echo '<p>Genre: ' . $row['genre'] . '</p>';
        }

        $sql2 = "SELECT schedule.schedule_id, schedule.date, schedule.hour FROM movies, schedule WHERE schedule.movie_id=movies.movie_id AND movies.movie_id=$movieId AND schedule.date >= NOW();";
        $result2 = $conn->query($sql2);


        if (mysqli_num_rows($result2) > 0) {
            $scheduleInfo = '';
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $scheduleId = $row2['schedule_id'];
                $date = $row2['date'];
                $hour = $row2['hour'];

                echo '<a href="select-seat.php?scheduleId=' . $scheduleId . '"><button type="submit" class="schedule-btn">' . $date . '<br>' . $hour . '</button></a>';

            }
            echo '</div>';

        } else {
            echo 'No schedule available for the selected movie.';
        }

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            echo 'Zaloguj się';
        }
        ?>
    </div>
    <div class="footer">
        <p>Designed and made by Jakub Sikorski</p>
    </div>
</body>

</html>