<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-manage-employee.css">
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
        <table>
            <tr>
                <th>Id</th>
                <th>Mail</th>
                <th>Login</th>
            </tr>
            <?php
            $sql = "SELECT id, email, login FROM users WHERE role=1";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["email"] . '</td>';
                echo '<td>' . $row["login"] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </div>
</body>

</html>