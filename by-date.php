<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-by-date.css">
    <title>TicketIT</title>
</head>

<body>
    <?php
    include("includes/header.php");
    if (isset($_SESSION["userId"]) && (($_SESSION["userRole"] === 1) || ($_SESSION["userRole"] === 2))){
    } else {
        header("Location: index.php");
        exit();
    }
    ?>

    <main>
        <div class="main-container">
            <form method="post">
                <p><input type="date" name="selected-date"></p>
                <p><input type="submit" value="Choose"></p>
            </form>
            <?php
    if (isset($_POST['selected-date'])) {
        $selectedDate = $_POST['selected-date'];
        echo "<p>" . $selectedDate . "</p>";
    }
    $date = mysqli_real_escape_string($conn, $selectedDate);
    $sql = "SELECT movies.title, movies.movie_id, schedule.schedule_id, schedule.hour, movies.poster FROM movies, schedule WHERE schedule.movie_id = movies.movie_id AND schedule.date = '$date'";
    $result = $conn->query($sql);
    echo '<div class="movie-container">';
    while($row = $result->fetch_assoc()){
        echo '<div class="link-container">';
        echo '<a href="#'.$row["movie_id"].'"><img src="'.$row["poster"].'"></a>';
        echo '<a href="employee-table.php?scheduleId='.$row["schedule_id"].'"><p>'.$row["hour"].'</p></a>';
        echo '</div>';
    }
    echo '</div>';
    ?>  
        </div>
    </main>
</body>

</html>