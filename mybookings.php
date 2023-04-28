<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-mybookings.css">
    <title>TicketIT</title>

</head>

<body>
    <?php
    include("includes/header.php");
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    ?>

    <div class="main-container">
        <div class="nav-container">
            <nav>
                <a href="currentbookings.php">Current bookings</a>
                <a href="bookingshistory.php">Bookings history</a>
            </nav>
        </div>

    </div>

    <div class="footer">
        <p>Jakub Sikorski</p>
    </div>
</body>

</html>