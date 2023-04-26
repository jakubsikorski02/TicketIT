<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="file-container">
        <form method="post" enctype="multipart/form-data">
            <label for="file">Choose an image:</label>
            <input type="file" name="file" id="file">
            <button type="submit">Upload</button>
        </form>
    </div>
    <?php
    include("dbconnection.php");

    if (isset($_FILES['file'])) {
        $imageData = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
        $imageType = $_FILES['file']['type'];
        $sql = "";

        if ($imageType == "image/png") {
            $imageInsert = "data:" . $imageType . ";base64," . $imageData;
            $sql = "INSERT INTO images (image) VALUES ('$imageInsert')";
        } elseif ($imageType == "image/jpeg") {
            $imageInsert = "data:" . $imageType . ";base64," . $imageData;
            $sql = "INSERT INTO images (image) VALUES ('$imageInsert')";
        } else {
            echo 'Use only PNG or JPEG files';
        }

        if ($sql != "" && $conn->query($sql)) {
            header("Location: index.php");
        }
    }

    echo '<img src="data:image/png;base64,' . $imageData . '">';
    ?>
</body>

</html>