<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style-employee-table.css">
</head>

<body>
  <?php
  include("includes/header.php");
  ?>
    <main>
  <div class="main-container">
    <?php

    $scheduleId = $_GET['scheduleId'];
    $sql = "SELECT movies.title, schedule.date, schedule.hour, cinema_hall.hall_name FROM cinema_hall, movies, schedule WHERE  schedule.schedule_id = $scheduleId AND movies.movie_id=schedule.movie_id AND schedule.hall_id = cinema_hall.hall_id;";
    $result = $conn->query($sql);
    $exist = true;
    echo '<div class="table-container">';
    if (mysqli_num_rows($result) > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="movie-info-container">';
        echo 'Title: ' . $row["title"] . '<br>';
        echo 'Date: ' . $row['date'] . '<br>';
        echo 'Hour: ' . date("H:i", strtotime($row["hour"])) . '<br>';
        echo 'Hall: ' . $row['hall_name'] . '<br>';

      }
      echo '</div>';
    } else {
      $exist = false;
    }




    if ($exist) {
      $sql2 = "SELECT schedule.schedule_id, seats.seat_id, seats.row_number, seats.seat_number FROM schedule, seats, cinema_hall WHERE seats.hall_id = cinema_hall.hall_id AND schedule.hall_id=cinema_hall.hall_id AND schedule.schedule_id=$scheduleId;";
      $result2 = $conn->query($sql2);
      $rows = array();
      echo '<h3>SCREEN</h3>';
      if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {

          if (array_key_exists($row2["row_number"], $rows)) {
            array_push($rows[$row2["row_number"]], $row2["seat_number"] = $row2["seat_id"]);
          } else {
            $rows[$row2["row_number"]] = array($row2["seat_number"] => $row2["seat_id"]);
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
      $sql3 = "SELECT seats.seat_number, seats.row_number, users.id, users.email FROM users, seats, booked, movies, schedule, cinema_hall WHERE booked.user_id = users.id AND booked.schedule_id = schedule.schedule_id AND schedule.movie_id = movies.movie_id AND booked.seat_id = seats.seat_id AND seats.hall_id = cinema_hall.hall_id AND schedule.schedule_id = $scheduleId;";
      $result3 = $conn->query($sql3);
      $takenSeats = array();
      while ($row3 = $result3->fetch_assoc()) {
        $takenSeats[$row3["row_number"]][$row3["seat_number"]] = true;
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
            if (isset($takenSeats[$row_number][$seat_number])) {
              echo '<input type="submit" name="takenSeat" style="background: #ff0000;" value=" ">';
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
      }
      
      echo '<div class="summary-container">';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $seatId = $rows[$selectedRowNumber][$selectedSeatNumber];
        $sql4 = "SELECT users.id, users.email FROM users, booked WHERE booked.user_id = users.id AND booked.seat_id = $seatId";
        $result4 = $conn->query($sql4);
        if ($result4->num_rows > 0) {
            $row4 = $result4->fetch_assoc();
            $bookedUserId = $row4["id"];
            $bookedUserEmail = $row4["email"];
        }
        echo 'Selected seat<br>';
        echo 'Row Number: ' . $selectedRowNumber . '<br>';
        echo 'Seat Number: ' . $selectedSeatNumber . '<br>';
        if(isset($bookedUserId)){
            echo 'Booked by: ' . $bookedUserEmail . '<br>';
        }
        else{
            echo 'Not booked yet<br>';
        }
        echo '<br>';
        echo '<form method="post">';
        echo '<input type="hidden" name="seatId" value="' . $seatId . '">';
        echo '<br>';
        echo '</form>';
    }
    } else {
      echo 'No movies for selected schedule.';
    }
    echo '</div>';
      echo '</div>';
    ?>
  </div>
  </main>
</body>

</html>