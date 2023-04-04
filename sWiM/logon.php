<!--
    Copyright from code and image - sWiM LTDA & SKB LTDA
-->

<?php

if (isset($_POST['submit'])) {
    include_once('config.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conection, "INSERT INTO accounts_swim(name,email,password) 
    VALUES ('$name','$email','$password')");
}
;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href=Icon.png width="30px">
    <title>sWiM - Log on</title>

</head>

<body>
    <div>
        <header>
            <a class="logo" href="index.html"><img src=Logo.png alt="sWiM" width="100px"></a>
            <nav>
                <div class="mobile-menu">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div class="mobile-menu">
                <ul class="nav-list">
                    <li><a href="category.html" style="text-decoration: none;">Categorias</a></li>
                    <li><a href="about.html" style="text-decoration: none;">Sobre</a></li>
                    <li><a href="login.php" style="text-decoration: none;">Entrar</a></li>
                </ul>
            </nav>
        </header>
    </div>
    <script type="text/javascript" src="main.js"></script>

    <main class="login">
        <div class="login">
            <h1>Cadastrar</h1>
            <div class="dados">
                <form method="POST" style="margin-bottom: -100px;" action="logon.php">
                    <h2 style="margin-top: 3rem; margin-left: 9%;">Nome de usuário:</h2>
                    <input type="text" name="name" id="name" maxlength="10" style="padding-left: 10px;" required>
                    <h2 style="font-size: 10px; letter-spacing: 2px; margin-left: 9%;">* No máximo 10 caracteres</h2>
                    <h2 style="margin-top: 1.8rem; margin-left: 9%;">Email:</h2>
                    <input type="email" name="email" maxlength="110" id="email" style="padding-left: 10px;" required>
                    <h2 style="margin-left: 9%;">Senha:</h2>
                    <input class="submit" type="password" name="password" id="password" maxlength="45"
                        style="padding-left: 10px;" required>
                    <input style="margin-top: 5rem; margin-left: 11.2%;" href="login.php" type="submit" name="submit" id="submit"
                        value="Log On">
                </form>
                <div class="dados" style="padding-top: 12vh; display: flex;">
                </div>
            </div>
        </div>
    </main>

    <div>
        <div class="footer" style="margin-top: 10vh;">
            <footer>
                <h5 class="footer" style="margin-left: 30px; margin-top: 30px; font-size: 18px;">&copy; Direitos
                    reservados
                    à Thiago Cordeiro Gluszczak</h5>
            </footer>
        </div>
    </div>
</body>

</html>