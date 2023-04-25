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
    <?php
    include("header.php");
    ?>
    <div class="main-container">
        <?php


        $sql = "SELECT DISTINCT movies.*
        FROM movies
        INNER JOIN schedule ON schedule.movie_id = movies.movie_id
        WHERE schedule.date >= NOW();";


        $result = $conn->query($sql);


        while ($row = $result->fetch_assoc()) {
            echo '<div class="movie-card">';
            echo '<img src="data:image/png;base64,' . $row['poster'] . '">';
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