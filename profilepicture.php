<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-settings.css">
    <title>TicketIT</title>
</head>

<body>
    <?php
    include("includes/header.php");
    if (!isset($_SESSION['userId'])) {
        header("Location: login.php");
        exit();
    }
    ?>
    <div class="main-container">
        <div class="nav-container">
            <nav>
                <a href="accountdetails.php">Account details</a>
                <a href="profilepicture.php">Profile picture</a>
            </nav>
        </div>
        <?php
        ?>
        <div class="file-container">
            <form method="post" enctype="multipart/form-data" accept="image/png, image/jpeg">
                <label for="file">Choose you avatar image:</label>
                <br>
                <?php
                if (isset($imageSrc)) {
                    echo '<img src="' . $imageSrc . '" class="profile-img-select">';
                } else {
                    echo 'No avatar image choosed yet';
                }
                ?>
                <br>
                <input type="file" name="file" id="file">
                <br>
                <button type="submit" class="submit-btn">Upload</button>
            </form>
        </div>
        <?php
        if (isset($_FILES['file'])) {
            $imageData = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
            $imageType = $_FILES['file']['type'];
            $sql = "";
            if ($imageType == "image/png") {
                $imageInsert = "data:" . $imageType . ";base64," . $imageData;
                $sql = "UPDATE users SET user_image = '$imageInsert' WHERE id = $userId";
            } elseif ($imageType == "image/jpeg") {
                $imageInsert = "data:" . $imageType . ";base64," . $imageData;
                $sql = "UPDATE users SET user_image = '$imageInsert' WHERE id = $userId";
            } else {
                echo 'Use only PNG or JPEG files';
            }

            if ($sql != "" && $conn->query($sql)) {
                header("Location: index.php");
            }
        }
        ?>
    </div>
    <div class="footer">
        <p>2023 © Jakub Sikorski</p>
    </div>
</body>

</html>