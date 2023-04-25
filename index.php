<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>TicketIT</title>
</head>

<body>
    <div class="container-header">
        <div class="logo">
            <h1><a href="index.php">TicketIT</a></h1>
        </div>
        <div class="about">
            <a href="#"><span class="about-us">About us</span></a>
            <a href="#"><span class="business">Business</span></a>
            <?php
            session_start();
            include("dbconnection.php");
            if (isset($_SESSION['user_id'])) {

                echo '<a href="movie-list.php"><span class="movies">Movies</span></a>';
            } else {
                echo '<a href="login.php"><span class="movies">Movies</span></a>';
            }
            ?>
        </div>
        <div class="profile-menu">
            <img src="images/profile.png" class="profile-menu-img">
            <div class="profile-menu-dropdown">
                <?php
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    echo '<a href="myaccount.php">My account</a>';
                    echo '<a href="#">Settings</a>';
                    echo '<a href="index.php?action=logout"><span>Log out</span></a>';
                } else {
                    echo '<a href="login.php"><span>Log in</span></a>';
                }

                if (isset($_GET['action']) && $_GET['action'] == "logout") {
                    unset($_SESSION['user_id']);
                    header("Location: index.php");
                    exit;
                }
                ?>
            </div>
        </div>
    </div>
    <div class="main-container">
        <div class="slider-container">
            <?php
            $sql = "SELECT poster, movie_id FROM movies";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<a href="schedule.php?movieId=' . $row['movie_id'] . '"><img src="data:image/png;base64,' . $row['poster'] . '"></a>';
                }
            } else {
                echo "No movie posters found.";
            }
            ?>
        </div>
        <div class="buttons">
            <button class="scroll-button scroll-button-left" id="prevButton">&#8249;</button>
            <button class="scroll-button scroll-button-right" id="nextButton">&#8250;</button>
        </div>
    </div>
    <div class="footer">
        <p>Jakub Sikorski</p>
    </div>

    <script>
        const sliderContainer = document.querySelector('.slider-container');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const slideWidth = sliderContainer.querySelector('img').offsetWidth;
        const sliderContainerWidth = sliderContainer.offsetWidth;

        prevButton.addEventListener('click', () => {
            sliderContainer.scrollBy({
                left: -sliderContainerWidth,
                behavior: 'smooth'
            });
        });

        nextButton.addEventListener('click', () => {
            sliderContainer.scrollBy({
                left: sliderContainerWidth,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>