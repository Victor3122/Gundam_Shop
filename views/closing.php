<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Closing Display</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Calibri, sans-serif;
            overflow: hidden;
        }

        header {
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            text-align: center;
            padding: 50px 50px 20px 50px;
            position: relative;
            z-index: 1;
        }

        header h1 {
            font-size: 48px;
            letter-spacing: 2px;
        }

        header p {
            font-size: 24px;
            letter-spacing: 2px;
        }

        #developers {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 50px;
            background-color: rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 1;
        }

        .developer {
            text-align: center;
            color: yellow;
        }

        .developer h3 {
            font-size: 36px;
            letter-spacing: 2px;
        }

        .developer p {
            font-size: 24px;
            letter-spacing: 2px;
        }

        #background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .title {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: #fff;
            font-size: 20px;
            letter-spacing: 2px;
        }

        .footer {
            color: white;
            font-size: 20px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            text-align: center;
            padding: 10px 0;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <h1>Description</h1>

        <p >We thank Lord for granting us the strength to complete this project. We sincerely thank Sayar Min Maung Maung for all the guidance he has provided throughout this semester.
            We are glad that we got a chance to expand our knowledge regarding PHP and many more things.</p>
        <!-- <p style="font-size:medium;">We sincerely thank Sayar Min Maung Maung for all the guidance he has provided throughout this semester.
            We are honored to have been taught web-related lessons.
            We are glad that we got a chance to expand our knowledge regarding
            PHP and many more things.There were times we did not manage to understand the lessons, but as we worked it out,
            we came to understand little by little.
            As we got to do the mini-projects every week, it benefited us in understanding
            how PHP worked and encouraged us to innovate our projects as we see fit. It also strengthened our friendship bonds and
            teamwork as we got a chance to do the project with our own groups.
            We are certain that we will be able to accomplish a
            lot more with all the lessons provided. We will put all that we have learned to use in our future careers.</p> -->
            <p> Please note : this website is not intended for commercial use. We created this website with the purpose of completing the final project of LAP 3.</p>
        <p><mark>Special Thanks to Our Benefitor Ko Phyo Min Paing for helping out with issues , erros and idea.</mark></p>
    </header>
    <section id="developers">
        <div class="developer">
            <h3>Frontend Developer</h3>
            <p>Thu Rein Aung</p>
            <img src="../controllers/images/static/closing/frontend1real.jpg" alt="Frontend Developer Image" style="max-width: 200px;">
        </div>
        <div class="developer">
            <h3>Backend Developer</h3>
            <p>Royal Victor Say</p>
            <img src="../controllers/images/static/closing/victor.jpg" alt="Backend Developer Image" style="max-width: 200px;">
        </div>
        <div class="developer">
            <h3>Database Admin</h3>
            <p>S' Shin Thant</p>
            <img src="../controllers/images/static/closing/database1real.jpg" alt="Database Developer Image" style="max-width: 200px;">
        </div>
    </section>

    <video id="background-video" autoplay muted loop>
        <source src="../controllers/images/static/Opening1.mp4" type="video/mp4">

    </video>

    <div class="footer">TRS Gundam Shop</div>

    <script>
        const video = document.getElementById("background-video");

        video.addEventListener("ended", function() {
            video.play();
        });
    </script>
</body>

</html>