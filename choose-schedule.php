<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-choose-schedule.css">
    <title>TicketIT</title>
</head>
<?php
include("includes/header.php");
?>

<main>
    <div class="main-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["movie"])) {
                $selectedMovieId = $_POST["movie"];
                $sql = "SELECT schedule.schedule_id, schedule.date, schedule.hour, movies.title FROM movies, schedule WHERE schedule.movie_id = movies.movie_id AND movies.movie_id = $selectedMovieId AND schedule.date >= NOW()";
                $result = $conn->query($sql);
                echo '<div class="avaliable-schedule">';
                echo '<h3>Selected movie: ';

                if ($row = $result->fetch_assoc()) {
                    echo $row["title"];
                }

                echo '</h3>';
                while ($row = $result->fetch_assoc()) {
                    echo '<a href="employee-table.php?scheduleId='.$row["schedule_id"].'">';
                    echo '<p>' . $row["date"] . '</p>';
                    echo '<p>' . $row["hour"] . '</p>';
                    echo '</a>';
                }
                echo '</div>';
            }
        }
        ?>
    </div>
</main>

</body>

</html>