<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style-select-seat.css">
</head>

<body>
  <?php
  include("includes/header.php");
  ?>
  <div class="main-container">
    <?php
            if(!isset($_SESSION['userId'])){
              header("Location: login.php");
          }
          else{
    $scheduleId = $_GET['scheduleId'];
    $sql2 = "SELECT movies.title, schedule.date, schedule.hour, cinema_hall.hall_name FROM cinema_hall, movies, schedule WHERE  schedule.schedule_id = $scheduleId AND movies.movie_id=schedule.movie_id AND schedule.hall_id = cinema_hall.hall_id;";
    $result2 = $conn->query($sql2);
    $exist = true;
    echo '<div class="select-container">';
    if (mysqli_num_rows($result2) > 0) {
      while ($row2 = $result2->fetch_assoc()) {
        echo '<h1>Choose seat</h1>';
        echo '<div class="movie-info-container">';
        echo 'Title: ' . $row2["title"] . '<br>';
        echo 'Date: ' . $row2['date'] . '<br>';
        echo 'Hour: ' . date("H:i", strtotime($row2["hour"])) . '<br>';
        echo 'Hall: ' . $row2['hall_name'] . '<br>';

      }
      echo '</div>';
    } else {
      $exist = false;
    }
    if ($exist) {
      $sql = "SELECT schedule.schedule_id, seats.seat_id, seats.row_number, seats.seat_number FROM schedule, seats, cinema_hall WHERE seats.hall_id = cinema_hall.hall_id AND schedule.hall_id=cinema_hall.hall_id AND schedule.schedule_id=$scheduleId;";
      $result = $conn->query($sql);
      $rows = array();

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

          if (array_key_exists($row["row_number"], $rows)) {
            array_push($rows[$row["row_number"]], $row["seat_number"] = $row["seat_id"]);
          } else {
            $rows[$row["row_number"]] = array($row["seat_number"] => $row["seat_id"]);
          }

        }
      } else {

      }

      $selectedRowNumber = null;
      $selectedSeatNumber = null;
      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $selectedRowNumber = $_POST["selectedRowNumber"];
        $selectedSeatNumber = $_POST["selectedSeatNumber"];
      }

      echo '<div class="choose-container">';
      echo '<h4>SCREEN</h4>';
      $sql4 = "SELECT seats.seat_number, seats.row_number FROM seats, booked, movies, schedule, cinema_hall WHERE booked.schedule_id = schedule.schedule_id AND schedule.movie_id = movies.movie_id AND booked.seat_id = seats.seat_id AND seats.hall_id = cinema_hall.hall_id AND schedule.schedule_id = $scheduleId;";
      $result4 = $conn->query($sql4);
      $taken_seats = array();
      while ($row4 = $result4->fetch_assoc()) {
        $taken_seats[$row4["row_number"]][$row4["seat_number"]] = true;
      }

      foreach ($rows as $row_number => $seats) {
        echo '<div class="seats-container">';
        echo '<table>';
        echo '<tr>';
        foreach ($seats as $seat_number => $seat_id) {
          echo '<td>';
          echo '<form method="post">';
          echo '<input type="hidden" name="selectedRowNumber" value="' . $row_number . '">';
          echo '<input type="hidden" name="selectedSeatNumber" value="' . $seat_number . '">';
          if ($selectedRowNumber == $row_number && $selectedSeatNumber == $seat_number) {
            echo '<input type="submit" name="selectedSeatId" style="background: #007bff;" value=" ">';
          } else {
            if (isset($taken_seats[$row_number][$seat_number])) {
              echo '<input type="submit" name="takenSeat" style="background: #ff0000;" value=" " disabled>';
            } else {
              echo '<input type="submit" name="selectedSeatId" style="background: #bbb;" value=" ">';
            }
          }
          echo '</form>';
          echo '</td>';
        }
        echo '</tr>';
        echo '</table>';
        echo '</div>';
      }
      echo '</div>';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $seatId = $_POST["selectedSeatId"];
        $userId = $_SESSION["userId"];
      }

      echo '<div class="summary-container">';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $seatId = $rows[$selectedRowNumber][$selectedSeatNumber];
        echo 'Selected seat<br>';
        echo 'Row Number: ' . $selectedRowNumber . '<br>';
        echo 'Seat Number: ' . $selectedSeatNumber . '<br>';
        echo '<br>';
        echo '<form method="post">';
        echo '<input type="hidden" name="seatId" value="' . $seatId . '">';
        echo '<br>';
        echo '<input type="submit" name="finalStep" value="Book your seat!">';
        echo '</form>';
        if (isset($_POST["finalStep"])) {
          $seatId = $_POST["seatId"];
          $userId = $_SESSION["userId"];
          echo $userId;
          $sql3 = "INSERT INTO `booked`(`booked_id`, `schedule_id`, `seat_id`, `user_id`) VALUES (NULL, $scheduleId, $seatId, $userId)";
          if ($conn->query($sql3)) {
            $insertedId = $conn->insert_id;
            $_SESSION['insertedId'] = $insertedId;
            echo '<script>window.location.href="summary.php";</script>';
            exit;

          } else {
            echo 'Failed';
          }
        }
      }
    } else {
      echo 'No movies for selected schedule.';
    }
    echo '</div>';
      echo '</div>';
  }
    ?>
  </div>
  <div class="footer">
    <p>2023 © Jakub Sikorski</p>
  </div>
</body>

</html>