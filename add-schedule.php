<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-add-schedule.css">
    <title>TicketIT</title>
</head>

<body>
    <?php
    include("includes/header.php");
    if (isset($_SESSION["userId"]) && ($_SESSION["userRole"] === 1) || ($_SESSION["userRole"] === 2)) {
    } else {
        header("Location: index.php");
        exit();
    }
    ?>

    <main>
        <div class="main-container">
            <h3>Add a schedule</h3>
            <form method="post">
                <p><input type="date" name="scheduleDate"></p>
                <p><input type="time" name="scheduleHour"></p>
                <p><select name="scheduleMovie">
                <?php
                    $sql = "SELECT title, movie_id FROM movies";
                    $result = $conn -> query($sql);
                    while($row = $result->fetch_assoc()){
                    echo '<option value="'.$row["movie_id"].'">'.$row["title"].'</option>';
                    }
                ?>
                </select></p>
                <p><select name="scheduleHall">
                <?php
                    $sql2 = "SELECT hall_name, hall_id FROM cinema_hall";
                    $result2 = $conn -> query($sql2);
                    while($row2 = $result2->fetch_assoc()){
                    echo '<option value="'.$row2["hall_id"].'">'.$row2["hall_name"].'</option>';
                    }
                ?>
                </select></p>
                <input type="submit" value="Add">
            </form>
        </div>
    </main>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $scheduleDate = $_POST["scheduleDate"];
    $scheduleHour = $_POST["scheduleHour"];
    $scheduleMovie = $_POST["scheduleMovie"];
    $scheduleHall = $_POST["scheduleHall"];

    $sql = "INSERT INTO schedule (`date`, `hour`, `movie_id`, `hall_id`, `employee`) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiis", $scheduleDate, $scheduleHour, $scheduleMovie, $scheduleHall, $_SESSION["userEmail"]);
    
    if ($stmt->execute()) {
        header("Location: employee.php");
        exit;
    } else {
        echo "<p>Failed</p>";
    }

    $stmt->close();
}
?>
</body>

</html>
