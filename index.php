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
    <?php
    include("header.php");
    ?>
    <div class="main-container">
        <div class="slider-container">
            <?php
            $sql = "SELECT poster, movie_id FROM movies";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<a href="schedule.php?movieId=' . $row['movie_id'] . '"><img src="' . $row['poster'] . '"></a>';
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