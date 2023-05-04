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
    <?php
    include("includes/header.php");
    ?>
    <div class="main-container">
        <h1>Order Summary</h1>
        <?php
            if(!isset($_SESSION['userId'])){
              header("Location: login.php");
          }
          else{
        $summaryId = $_SESSION["insertedId"];
        $sql = "SELECT movies.title, seats.row_number, seats.seat_number, schedule.date, schedule.hour, cinema_hall.hall_name 
            FROM movies, seats, schedule, booked, cinema_hall 
            WHERE booked.schedule_id = schedule.schedule_id AND schedule.movie_id = movies.movie_id AND booked.seat_id = seats.seat_id AND seats.hall_id = cinema_hall.hall_id AND booked_id = $summaryId";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="summary-container">';
                echo '<p>Title: ' . $row["title"] . '</p>';
                echo '<p>Row Number: ' . $row["row_number"] . '</p>';
                echo '<p>Seat Number: ' . $row["seat_number"] . '</p>';
                echo '<p>Date: ' . $row["date"] . '</p>';
                echo '<p>Hour: ' . $row["hour"] . '</p>';
                echo '<p>Hall Name: ' . $row["hall_name"] . '</p>';
                echo '<button class="summary-btn"><a href="currentbookings.php">Check your bookings</a></button>';
                echo '</div>';
            }
        } else {
            echo '<a href="movie-list.php">Book now!</a>';
        }
       }
        ?>
    </div>
    <div class="footer">
        <p>2023 © Jakub Sikorski</p>
    </div>
</body>

</html>
