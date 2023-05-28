<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-manager.css">
    <title>TicketIT</title>
</head>

<body>
    <?php
    include("includes/header.php");
    if (isset($_SESSION["userId"]) && $_SESSION["userRole"] === 2) {
    } else {
        header("Location: index.php");
        exit();
    }
    ?>
    <div class="main-container">
        <a href="manage-employee.php">
            <p>&#x1F464; MANAGE EMPLOYEES</p>
        </a>
        <a href="employee.php">
            <p>&#x1F4DD; MANAGE MOVIES/SCHEDULE</p>
        </a>
    </div>
</body>

</html>