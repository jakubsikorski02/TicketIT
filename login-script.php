<?php
include("dbconnection.php");
if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $user_password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE login=?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        if (password_verify($user_password, $hashed_password)) {
            $_SESSION["logged"] = true;
            $_SESSION["user_id"] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            // wyświetl błąd, gdy hasło jest nieprawidłowe
            echo "<div class='container-login'><p class='error'>Nieprawidłowe hasło.</p></div>";
        }
    } else {
        // wyświetl błąd, gdy login jest nieprawidłowy
        echo "<div class='container-login'><p class='error'>Nieprawidłowy login.</p></div>";
    }
}
?>