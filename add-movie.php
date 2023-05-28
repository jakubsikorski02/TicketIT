<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="style/style-add-movie.css">
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

            <h3>Add a movie</h3>
            <form method="post" enctype="multipart/form-data">
                <p>
                    <label for="movieDirector">Movie director</label>
                    <input type="text" name="movieDirector" id="movieDirector" placeholder="Movie director">
                </p>
                <p>
                    <label for="movieTitle">Movie title</label>
                    <input type="text" name="movieTitle" id="movieTitle" placeholder="Movie title">
                </p>
                <p>
                    <label for="movieYear">Year</label>
                    <input type="number" name="movieYear" id="movieYear" min="1900" max="2023" step="1" placeholder="Year" maxlength="11">
                </p>
                <p>
                    <label for="movieDescription">Movie description</label>
                    <textarea name="movieDescription" id="movieDescription" placeholder="Movie description" maxlength="255" oninput="this.style.height = ''; this.style.height = this.scrollHeight + 'px'"></textarea>
                </p>
                <p>
                    <label for="movieGenre">Movie genre</label>
                    <select name="movieGenre" id="movieGenre">
                        <option>Action</option>
                        <option>Comedy</option>
                        <option>Drama</option>
                        <option>Fantasy</option>
                        <option>Science Fiction</option>
                        <option>Crime</option>
                        <option>Horror</option>
                        <option>Mystery</option>
                        <option>Romance</option>
                        <option>Thriller</option>
                        <option>Western</option>
                    </select>
                </p>
                <p>
                    <label for="movieDuration">Duration</label>
                    <input type="number" name="movieDuration" id="movieDuration" maxlength="11" placeholder="Duration">
                </p>
                <p>
                    <label for="moviePoster">Movie poster</label>
                    <input type="file" name="moviePoster" id="moviePoster">
                </p>
                <p>
                    <input type="submit" value="Add">
                </p>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $movieDirector = $_POST["movieDirector"];
                $movieTitle = $_POST["movieTitle"];
                $movieYear = $_POST["movieYear"];
                $movieDescription = $_POST["movieDescription"];
                $movieGenre = $_POST["movieGenre"];
                $movieDuration = $_POST["movieDuration"];
                $moviePoster = base64_encode(file_get_contents($_FILES['moviePoster']['tmp_name']));
                $imageType = $_FILES['moviePoster']['type'];
                if ($imageType == "image/png") {
                    $imageInsert = "data:" . $imageType . ";base64," . $moviePoster;
                } elseif ($imageType == "image/jpeg") {
                    $imageInsert = "data:" . $imageType . ";base64," . $moviePoster;
                } else {
                    echo 'Use only PNG or JPEG files';
                }

                $sql = "INSERT INTO movies (`director`, `title`, `year`, `description`, `genre`, `duration`, `poster`, `employee`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssississ", $movieDirector, $movieTitle, $movieYear, $movieDescription, $movieGenre, $movieDuration, $moviePoster, $_SESSION["userEmail"]);

                if ($stmt->execute()) {
                    header("Location: employee.php");
                    exit;
                } else {
                    echo "<p>Failed</p>";
                }

                $stmt->close();
            }
            ?>
        </div>
    </main>
</body>

</html>