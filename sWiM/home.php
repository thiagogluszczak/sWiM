<!--
    Copyright from code and image - sWiM LTDA & SKB LTDA
-->

<?php
session_start();
if ((!isset($_SESSION['name']) == true) and (!isset($_SESSION['password']) == true) and (!isset($_SESSION['email']) == true)) {
    unset($_SESSION['name']);
    unset($_SESSION['password']);
    unset($_SESSION['email']);
    header('Location: login.php');
}
$sql = "SELECT * FROM accounts_swim";

$user = $_SESSION['name'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link href="style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="icon" type="image/png" href=Icon.png width="30px">
    <title>sWiM - Homepage</title>
</head>

<body>
    <div>
        <header>
            <a class="logo" href="home.php"><img src="Logo.png" alt="sWiM" width="100px"></a>
            <nav>
                <div class="mobile-menu">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div class="mobile-menu">
                <ul class="nav-list">
                    <li><a href="category.html" style="text-decoration: none;">Categorias</a></li>
                    <li><a href="about.html" style="text-decoration: none;">Sobre</a></li>
                    <li><a href="profile.php" style="text-decoration: none;">
                            <img class="avatar" src="avatar\avatar_1.png">
                            <?php
                            echo "$user";
                            ?>
                        </a></li>
                </ul>
            </nav>
        </header>
    </div>
    <script type="text/javascript" src="main.js"></script>

    <main>
        <div class="main">
            <h1 class="welcome">Olá
                <?php echo "$user"; ?>
            </h1>
            <div class="recent">
                <a href="at-risk.php" class='lk' onmouseover="detail()" onmouseout="detailoff()">
                    <img class="rgame" id='rgame' style="opacity: 1; position: absolute; z-index: 1;"
                        onmouseover="detail()" onmouseout="detailoff()"
                        src="https://cbissn.ibict.br/images/phocagallery/galeria2/thumbs/phoca_thumb_l_image03_grd.png">
                    <div class="details" onmouseover="detail()" onmouseout="detailoff()" id='dtl'>
                        <h5 class='rgame'>At Risk</h5>
                    </div>
                </a>
                <script>
                    function detail() {
                        document.getElementById('dtl').style.zIndex = '1';
                    }
                    function detailoff() {
                        document.getElementById('dtl').style.zIndex = '0';
                    }

                    const rgb = document.getElementById('dtl')
                    let id = null;
                    let x = 0;
                    clearInterval(id);

                    id = setInterval(angle, 25);
                    function angle() {
                        if (x == 360) {
                            clearInterval(id);
                            x = 0;
                        } else if (x == 0) {
                            id = setInterval(angle, 1000);
                        } {
                            x++;
                            rgb.style.background = 'linear-gradient(' + x + 'deg, rgba(64, 65, 59, 0.4), #ffff4c90, #b83dba)';
                        }
                    }

                </script>
            </div>
        </div>
    </main>

    <div>
        <div class="footer">
            <footer>
                <h5 class="footer" style="margin-left: 30px; margin-top: 30px; font-size: 18px;">&copy; Direitos
                    reservados
                    à Thiago Cordeiro Gluszczak</h5>
            </footer>
        </div>
    </div>
</body>

</html>