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
    <title>sWiM - At Risk</title>
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

    <main style="margin-bottom: 100px;">
        <div class="main">
            <canvas class="game"></canvas>

        </div>
    </main>
    <script>
        const canvas = document.querySelector('canvas')
        const c = canvas.getContext('2d')

        canvas.width = innerWidth
        canvas.height = innerHeight

        c.fillRect(0, 0, canvas.width, canvas.height);

        const g = 0.7

        class sprite {
            constructor({ position, v, width, height, color = 'red' }) {
                this.position = position
                this.v = v
                this.width = 50
                this.height = 96
                this.lastKey
                this.attackBox = {
                    position: this.position,
                    width: 100,
                    height: 50
                }
                this.color = color
                this.isAtk
            }

            draw() {
                c.fillStyle = this.color
                c.fillRect(this.position.x, this.position.y, this.width, this.height)

                if (this.isAtk) {
                    c.fillStyle = 'rgba(142, 170, 30, 0.9)'
                    c.fillRect(
                        this.attackBox.position.x,
                        this.attackBox.position.y,
                        this.attackBox.width,
                        this.attackBox.height

                    )
                }
            }

            update() {
                this.draw()

                this.position.x += this.v.x
                this.position.y += this.v.y

                if (this.position.y + this.height + this.v.y >= canvas.height - 50) {
                    this.v.y = 0
                } else this.v.y += g

                if (this.position.y - this.v.y <= 80) {
                    keys.w.pressed = false
                }

                if (this.position.x <= 0) {
                    keys.a.pressed = false
                    this.v.x = 0
                }

                if (this.position.x + this.width > canvas.width - 2) {
                    keys.d.pressed = false
                    this.v.x = 0
                }
            }

            attack() {
                this.isAtk = true
                setTimeout(() => {
                    this.isAtk = false
                }, 100)
            }
        }


        const player1 = new sprite({
            position: {
                x: 0.2 * innerWidth,
                y: innerHeight - 156
            },
            v: {
                x: 0,
                y: 10
            }
        })

        player1.draw()

        const player2 = new sprite({
            position: {
                x: 0.8 * innerWidth - 50,
                y: innerHeight - 156
            },
            v: {
                x: 0,
                y: 10
            },

            color: 'blue'
        })

        player2.draw()

        console.log(player1, player2)

        const keys = {
            a: {
                pressed: false
            },

            d: {
                pressed: false
            },

            w: {
                pressed: false
            },

            ArrowLeft: {
                pressed: false
            },

            ArrowRight: {
                pressed: false
            },

            ArrowUp: {
                pressed: false
            }
        }

        let lastKey

        function animate() {
            window.requestAnimationFrame(animate);
            c.fillStyle = 'black'
            c.fillRect(0, 0, canvas.width, canvas.height)
            player1.update()
            player2.update()

            player1.v.x = 0
            player2.v.x = 0

            if (keys.a.pressed && player1.lastKey === 'a') {
                player1.v.x = -5
            } else if (keys.d.pressed && player1.lastKey === 'd') {
                player1.v.x = 5
            } else if (keys.w.pressed && player1.lastKey === 'w' && player1.position.y > 0.5 * canvas.height) {
                player1.v.y = -7
            }

            if (keys.ArrowLeft.pressed && player2.lastKey === 'ArrowLeft') {
                player2.v.x = -5
            } else if (keys.ArrowRight.pressed && player2.lastKey === 'ArrowRight') {
                player2.v.x = 5
            } else if (keys.ArrowUp.pressed && player2.lastKey === 'ArrowUp' && player2.position.y > 0.5 * canvas.height) {
                player2.v.y = -7
            }

            if (
                player1.attackBox.position.x + player1.attackBox.width >= player2.position.x &&
                player1.attackBox.position.x <= player2.position.x + player2.width &&
                player1.attackBox.position.y + player1.attackBox.height >= player2.position.y &&
                player1.attackBox.position.y <= player2.position.y + player2.height &&
                player1.isAtk) {
                player1.isAtk = false
                player2.color = 'yellow'
                setTimeout(() => {
                    return player2.color = 'blue'
                }, 650);
            } else if (
                player2.attackBox.position.x <= player1.position.x + player1.width &&
                player2.attackBox.position.x + player2.attackBox.width >= player1.position.x &&
                player2.attackBox.position.y + player2.attackBox.height >= player1.position.y &&
                player2.attackBox.position.y <= player1.position.y + player1.height &&
                player2.isAtk) {
                player2.isAtk = false
                player1.color = 'yellow'
                setTimeout(() => {
                    return player1.color = 'red'
                }, 650);
            }
        }

        window.addEventListener("keydown", function (e) {
            if (["Space", "ArrowUp", "ArrowDown", "ArrowLeft", "ArrowRight"].indexOf(e.code) > -1) {
                e.preventDefault();
            }
        }, false);

        animate()

        window.addEventListener('keydown', () => {
            switch (event.key) {
                //player1
                case 'd':
                    keys.d.pressed = true
                    player1.lastKey = 'd'
                    break
                case 'a':
                    keys.a.pressed = true
                    player1.lastKey = 'a'
                    break
                case 'w':
                    keys.w.pressed = true
                    player1.lastKey = 'w'
                    break
                case 'c':
                    player1.attack()
                    break

                //player2
                case 'ArrowRight':
                    keys.ArrowRight.pressed = true
                    player2.lastKey = 'ArrowRight'
                    break
                case 'ArrowLeft':
                    keys.ArrowLeft.pressed = true
                    player2.lastKey = 'ArrowLeft'
                    break
                case 'ArrowUp':
                    keys.ArrowUp.pressed = true
                    player2.lastKey = 'ArrowUp'
                    break
                case 'ArrowDown':
                    player2.attack()
                    break
            }
            console.log(event.key)
        })

        window.addEventListener('keyup', () => {
            switch (event.key) {
                case 'd':
                    keys.d.pressed = false
                    break
                case 'a':
                    keys.a.pressed = false
                    break
                case 'w':
                    keys.w.pressed = false
                    break

                case 'ArrowRight':
                    keys.ArrowRight.pressed = false
                    break
                case 'ArrowLeft':
                    keys.ArrowLeft.pressed = false
                    break
                case 'ArrowUp':
                    keys.ArrowUp.pressed = false
                    break
            }
            console.log(event.key)
        })

        console.log(player1.position.y)
    </script>
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