<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-employee.css">
    <title>TicketIT</title>
</head>

<body>
    <?php
    include("includes/header.php");
    if (isset($_SESSION["userId"]) && (($_SESSION["userRole"] === 1) || $_SESSION["userRole"] === 2)) {
    }else {
        header("Location: index.php");
        exit();
    }
    ?>

    <main>
        <div class="main-container">
            <a href="by-movies.php"><p>BY MOVIES  &#x1F3A5;</p></a>
            <a href="by-date.php"><p>BY DATE &#x1F4C5;</p></a>
            <a href="add-movie.php"><p>ADD MOVIE &#x1F3A5;</p></a>
            <a href="add-schedule.php"><p>ADD SCHEDULE &#x1F4C5;</p></a>
        </div>
    </main>

</body>

</html>