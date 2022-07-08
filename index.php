<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'creativity';

$dsn = "mysql:host=$host;dbname=$dbName";

$pdo = new PDO($dsn, $user, $password);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>

<div class="innerBody bg-light py-2 py-md-5">
    <div class="container-fluid">
        <!-- form card start -->
        <div class="card rounded-0 border-0 shadow p-3 p-md-3 m-auto col-12 col-sm-9 col-md-6">
            <h1 class="m-auto mb-3 fw-bolder">Filmlar</h1>

            <!-- carusel start -->
            <div id="carouselExampleControls" class="carousel slide  mb-3" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./image/mrBean.png" class="d-block w-100" alt="Photo">
                    </div>
                    <div class="carousel-item">
                        <img src="./image/mrBean1.jpg" class="d-block w-100" alt="Photo">
                    </div>
                    <div class="carousel-item">
                        <img src="./image/mrBean3.jpeg" class="d-block w-100" alt="Photo">
                    </div>
                    <div class="carousel-item">
                        <img src="./image/mrBean4.jpg" class="d-block w-100" alt="Photo">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <h3 class="mb-3 fw-bolder">Mr. Bin Ta'tilda</h3>
            <p class="mb-5 opacity-75">Mr. Bin filmi komedik janrda ishlangan bo’lib, film voqealari Fransiyada yuz beradi. Filmda bosh rolni Rowan Sebastian Atkinson ijro etadi.</p>
            <!-- form start -->
            <h5 class="mb-3 opacity-75">Film haqida izoh qoldiring:</h5>

            <?php
            if (!isset($_GET['fullName']))
            {

            } else
            {
                $pdoStatement = $pdo->prepare("INSERT INTO `comments` (`fullName`, `nickName`, `text`) VALUES (:fullName, :nickName, :text)");

                $pdoStatement->bindParam(':fullName', $_GET['fullName']);
                $pdoStatement->bindParam(':nickName', $_GET['nickName']);
                $pdoStatement->bindParam(':text', $_GET['text']);

                if (!$pdoStatement->execute())
                {
                    echo 'bazaga insert qilishda xato bor';
                    exit;
                }
                echo 'Izohingiz uchun rahmat!';
            }

            ?>
            <form class="form row opacity-75 justify-content-between m-auto">
                <input type="text" class="col-12 form-control col-md py-2 me-md-2 mb-3" name="fullName" placeholder="F.I.O ni kiriting" required>
                <input type="text" class="col-12 form-control col-md py-2 mb-3" name="nickName" placeholder="Username ni kiriting" required>
                <textarea name="text" class="col-12 form-control mb-3 py-2" cols="30" rows="5" placeholder="Izoh qoldiring..."></textarea>
                <button type="submit" class="btn btn-secondary py-2 mb-3 col-12 col-md-6" >Jo'natish</button>
            </form><hr>
            <h5 class="mb-3 opacity-75">Izohlar</h5>
            <div class="comments">
                <?php
                $pdoStatement = $pdo->prepare("SELECT * FROM `comments`");
                if (!$pdoStatement->execute())
                {
                    echo '->execute da xato';
                    exit;
                }
                while ($row = $pdoStatement->fetch())
                {
                    ?>
                <div class="comment row mb-3">
                    <div class="border-end border-2 col-1"></div>
                    <div class="comBody col">
                        <h6 class="mb-3 opacity-75">
                            <?php echo $row['nickName']; ?>
                        </h6>
                        <p class="opacity-50"><em>
                                <?php echo $row['text']; ?>
                            </em></p>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
        <!-- form-card end -->
    </div>

</div>

<!-- js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>