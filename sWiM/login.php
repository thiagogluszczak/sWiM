<!--
    Copyright from code and image - sWiM LTDA & SKB LTDA
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href=Icon.png width="30px">
    <title>sWiM - Log in</title>

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
            <h1>Entrar</h1>
            <div class="dados">
                <form method="POST" style="margin-bottom: -90px; display: grid;" action="testlogin.php">
                    <h2 style="margin-top: 1.8rem;">Email:</h2>
                    <input type="email" name="email" maxlength="110" id="email" style="padding-left: 10px; margin-top: 1rem;" required>
                    <h2 style="margin-top: 1.8rem;">Senha:</h2>
                    <input type="password" name="password" id="password" maxlength="45" style="padding-left: 10px; margin-top: 1rem;"
                        required>
                    <input class="submit" href="home.php" style="margin-top: 5rem; cursor: pointer;" type="submit"
                        name="submit" id="submit" value="Log In">
                </form>
                <div class="dados" style="padding-top: 12vh;">
                    <h2 style="border-top: 1px solid #ffff4c; width: 100%; display: flex; padding-top: 2.3rem;">Não
                        possui uma conta?<a href="logon.php"
                            style="font-size: 20px; text-decoration: none; margin-left: auto;"> Cadastre-se</a></h2>
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