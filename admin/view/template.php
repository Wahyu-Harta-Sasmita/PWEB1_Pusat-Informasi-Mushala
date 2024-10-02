<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        body a {
            text-decoration: none;
            color: black;
        }

        .container {
            display: flex;
            gap: 10px;
            width: 100%;
            height: 95%;
        }

        .container aside {
            height: 95%;
            width: 15%;
        }

        .container aside .menu1 {
            border-bottom: 1px solid black;
            margin-top: 2px;
            font-size: 15px;
        }

        .container-content {
            width: 85%;
            overflow-y: auto;
            padding: 10px;
            direction: rtl;
            text-align: left;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            justify-content: flex-start;
            direction: ltr;
        }

        .card-wrapper {
            display: flex;
        }

        .container-content .add-btn {
            position: fixed;
            z-index: 9999;
            bottom: 10px;
            right: 10px;
        }

        .container-content .add-btn img {
            width: 40px;
            height: 40px;
        }
    </style>

</head>

<body>
    <nav class="navbar" style="background-color:aquamarine;">
        <div class="container-fluid">
            <a class="navbar-brand" style="font-weight: bold;">Pusat Informasi Al-Mubhaligin</a>
            <div class="logout">
                <img src="/php_test1/assets/images/logout.png" alt="logout-icon" width="20px" height="20px">
                <a style="text-decoration: none; color:black; font-style:italic" href="/php_test1/admin/controller/logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
    <?php
        include_once __DIR__ . '/sidebar/sidebar.php';
    ?>

        <div class="container-content">
            <div class="card-container">
                <?php
                $content = __DIR__ . '/../view/dokter/tampil.php';
                echo '<div class="card-wrapper">';
                include_once $content;
                echo '</div>';
                ?>
            </div>

            <div class="add-btn">
                <?php include_once __DIR__ . '/button/add.php' ?>
            </div>

        </div>
    </div>
</body>

</html>