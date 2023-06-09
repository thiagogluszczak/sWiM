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
$user = $_SESSION['name'];
$email = $_SESSION['email'];

$sql = "SELECT * FROM accounts_swim";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link href="style.css?v=<?php echo time(); ?>" type="text/css" rel="stylesheet">
    <link rel="icon" type="image/png" href=Icon.png width="30px">
    <title>sWiM - Profile</title>
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
            <div class="profile">
                <img class="profile" src="avatar\avatar_1.png">
                <div class="column">
                    <h1 class="profile">Usuário:
                        <?php echo "$user"; ?>
                    </h1>
                    <h1 class="profile">Email:
                        <?php echo "$email"; ?>
                    </h1>
                </div>
            </div>
            <div class="leave">
                <a class="leave" href="leave.php">Sair da conta</a>
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