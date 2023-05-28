<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketIT</title>
    <link rel="stylesheet" href="style/style-schedule.css">
</head>

<body>
    <?php
    include("includes/header.php");
    ?>
    <div class="main-container">
        <div class="schedule-container">
            <h1>Choose date</h1>
            <?php
            $movieId = $_GET['movieId'];

            $sql = "SELECT * FROM movies WHERE movie_id= $movieId";
            $result = $conn->query($sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="selected-movie">';
                echo '<img src="' . $row['poster'] . '">';
                echo '<div class="movie-info">';
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
                    $hour = date("H:i", strtotime($row2["hour"]));

                    echo '<a href="select-seat.php?scheduleId=' . $scheduleId . '"><button type="submit" class="schedule-btn">' . $date . '<br>' . $hour . '</button></a>';

                }
                echo '</div>';
                echo '</div>';

            } else {
                echo 'No schedule available for the selected movie.';
            }
            ?>
        </div>
    </div>
    <div class="footer">
        <p>2023 © Jakub Sikorski</p>
    </div>
</body>

</html>