<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-currentbookings.css">
    <title>TicketIT</title>
</head>

<body>

    <?php
    include("header.php");
    if (!isset($_SESSION['userId'])) {
        header("Location: login.php");
        exit();
    }
    ?>
    <div class="main-container">
        <div class="nav-container">
            <nav>
                <a href="currentbookings.php">Current bookings</a>
                <a href="bookingshistory.php">Bookings history</a>
            </nav>
        </div>
        <?php
        $sql = "SELECT movies.title, seats.row_number, seats.seat_number, schedule.date, schedule.hour, cinema_hall.hall_name 
            FROM movies, seats, schedule, booked, cinema_hall, users
            WHERE booked.user_id = users.id AND booked.schedule_id = schedule.schedule_id AND schedule.movie_id = movies.movie_id AND booked.seat_id = seats.seat_id AND seats.hall_id = cinema_hall.hall_id AND schedule.date <= NOW() AND users.id = $userId";
        $result = $conn->query($sql);
        echo '<div class="bookings-container">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="info-container">';
            echo '<p>Title: ' . $row["title"] . '</p>';
            echo '<p>Row number: ' . $row["row_number"] . '</p>';
            echo '<p>Seat number: ' . $row["seat_number"] . '</p>';
            echo '<p>Date: ' . $row["date"] . '</p>';
            echo '<p>Hour: ' . $row["hour"] . '</p>';
            echo '<p>Hall name: ' . $row["hall_name"] . '</p>';
            echo '</div>';
        }
        echo '</div>';
        ?>
    </div>
    <div class="footer">
        <p>Jakub Sikorski</p>
    </div>
</body>

</html>