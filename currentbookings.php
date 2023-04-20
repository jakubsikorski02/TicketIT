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
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT movies.title, seats.row_number, seats.seat_number, schedule.date, schedule.hour, cinema_hall.hall_name 
            FROM movies, seats, schedule, booked, cinema_hall 
            WHERE booked.schedule_id = schedule.schedule_id AND schedule.movie_id = movies.movie_id AND booked.seat_id = seats.seat_id AND seats.hall_id = cinema_hall.hall_id AND user_id = $user_id";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo '<div class="main-content">';
        echo '<p>'.$row["title"].'</p>';
        echo '<p>'.$row["row_number"].'</p>';
        echo '<p>'.$row["seat_number"].'</p>';
        echo '<p>'.$row["date"].'</p>';
        echo '<p>'.$row["hour"].'</p>';
        echo '<p>'.$row["hall_name"].'</p>';
        echo '<hr>';
        echo '</div>';
    }
    ?>
    </body>
</html>   