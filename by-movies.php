<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-by-movies.css">
    <title>TicketIT</title>
</head>
<?php
include("includes/header.php");
if (isset($_SESSION["userId"]) && (($_SESSION["userRole"] === 1) || ($_SESSION["userRole"] === 2))) {
} else {
    header("Location: index.php");
    exit();
}
?>

<main>
    <div class="main-container">
        <?php
        $sql = "SELECT title, movie_id FROM movies";
        $result = $conn->query($sql);
        echo '<div class="movie-container">';
        echo '<form method="post" action="choose-schedule.php">';
        echo '<p><select name="movie">';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row["movie_id"] . '">' . $row["title"] . '</option>';
        }
        echo '</select></p>';
        echo '<p><input type="submit" value="Choose"></p>';
        echo '</form>';
        echo '</div>';
        ?>
    </div>
</main>

<body>
</body>

</html>