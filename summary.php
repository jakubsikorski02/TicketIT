<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-summary.css">
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

                echo '<a href="movie-list.php"><span>Check the movies</span></a>';
            } else {
                echo '<a href="login.php"><span>Check the movies</span</a>';
            }

            echo '</div>';
            echo '<div class="profile-menu">';
            echo '<img src="images/profile.png" class="profile-menu-img">';
            echo '<div class="profile-menu-dropdown">';

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

            }


            ?>
        </div>
    </div>
    </div>
    <h1>Order Summary</h1>
    <div class="summary-container">
        <?php
        include('dbconnection.php');
        $summaryId = $_SESSION["insertedId"];
        $sql = "SELECT movies.title, seats.row_number, seats.seat_number, schedule.date, schedule.hour, cinema_hall.hall_name 
            FROM movies, seats, schedule, booked, cinema_hall 
            WHERE booked.schedule_id = schedule.schedule_id AND schedule.movie_id = movies.movie_id AND booked.seat_id = seats.seat_id AND seats.hall_id = cinema_hall.hall_id AND booked_id = $summaryId";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo 'Title: ' . $row["title"] . '<br>';
                echo 'Row Number: ' . $row["row_number"] . '<br>';
                echo 'Seat Number: ' . $row["seat_number"] . '<br>';
                echo 'Date: ' . $row["date"] . '<br>';
                echo 'Hour: ' . $row["hour"] . '<br>';
                echo 'Hall Name: ' . $row["hall_name"] . '<br>';
                echo '<button><a href="currentbookings.php">Check your bookings</a></button>';
            }
        } else {
            echo '<a href="movie-list.php">Book now!</a>';
        }
        ?>
        </div>
        <div class="footer">
            <p>Designed and made by Jakub Sikorski</p>
        </div>
</body>

</html>