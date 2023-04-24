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
        //tutorial link video https://youtu.be/vyqbNFMDRGQ

        const canvas = document.querySelector('canvas')
        const c = canvas.getContext('2d')

        canvas.width = innerWidth
        canvas.height = innerHeight

        c.fillRect(0, 0, canvas.width, canvas.height);

        const g = 1

        class sprite {
            constructor({ position, v, width, height, color, offset, money }) {
                this.position = position
                this.v = v
                this.width = 50
                this.height = 96
                this.attackBox = {
                    position: {
                        x: this.position.x,
                        y: this.position.y
                    },
                    offset,
                    width: 100,
                    height: 50
                }
                this.color = color
                this.money = {
                    position: {
                        x: 0,
                        y: 0
                    },
                    width: 100,
                    height: 30
                }
                this.value = 1000
                this.isAtk
            }

            draw() {
                c.fillStyle = this.color
                c.fillRect(this.position.x, this.position.y, this.width, this.height)

                c.fillStyle = 'orange'
                c.fillRect(canvas.width * 0.5 - 50, innerHeight * 0.7, 100, 20),
                c.fillRect(0, innerHeight * 0.5, canvas.width * 0.4, 20),
                c.fillRect(canvas.width * 0.6, innerHeight * 0.5, canvas.width * 0.4, 20)

                c.font = '23px Tahoma'
                c.fillStyle = 'purple'
                c.fillText(this.value, this.position.x, this.position.y - 10)

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
                this.attackBox.position.x = this.position.x + this.attackBox.offset.x
                this.attackBox.position.y = this.position.y

                this.position.x += this.v.x
                this.position.y += this.v.y

                if (this.position.y + this.height + this.v.y >= canvas.height - 50 ||
                    innerHeight * 0.7 + 20 >= this.position.y + this.height + this.v.y &&
                    Block({ ply: this })) {
                    this.v.y = 0
                } else this.v.y += g

                if (this.position.x <= 0) {
                    keys.a.pressed = false
                    this.v.x = 0
                }

                if (this.position.x + this.width > canvas.width - 2) {
                    keys.d.pressed = false
                    this.v.x = 0
                }

                if (this.position.x + this.width > canvas.width - 2) {
                    keys.ArrowRight.pressed = false
                    this.v.x = 0
                }

                if (this.position.x <= 0) {
                    keys.ArrowLeft.pressed = false
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
            },
            color: 'green',
            offset: {
                x: 0,
                y: 100
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
            color: 'blue',
            offset: {
                x: -50,
                y: 0
            }
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

        var pi = innerHeight - 146
        var p1 = innerHeight * 0.8

        function Block({ ply }) {
            return (
                ply.position.y + ply.height + ply.v.y >= innerHeight * 0.7 &&
                ply.position.x + ply.width + ply.v.x <= innerWidth * 0.5 + 100 &&
                innerWidth * 0.5 - 50 <= ply.position.x + ply.width + ply.v.x
            )
        }

        function Collision({ ply1, ply2 }) {
            return (
                ply1.attackBox.position.x + ply1.attackBox.width >= ply2.position.x &&
                ply1.attackBox.position.x <= ply2.position.x + ply2.width &&
                ply1.attackBox.position.y + ply1.attackBox.height >= ply2.position.y &&
                ply1.attackBox.position.y <= ply2.position.y + ply2.height &&
                ply1.isAtk)
        }

        function animate() {
            window.requestAnimationFrame(animate);
            c.fillStyle = 'black'
            c.fillRect(0, 0, canvas.width, canvas.height)
            player1.update()
            player2.update()

            player1.v.x = 0
            player2.v.x = 0

            player2.money.position.x = innerWidth - 100

            if (keys.a.pressed) {
                player1.v.x = -5,
                    player1.attackBox.offset.x = -50
                if (keys.d.pressed) {
                    player1.v.x = 0
                }
                if (keys.w.pressed && player1.position.y == pi || keys.w.pressed && Block({ ply: player1 })) {
                    keys.w.pressed = false
                    player1.v.y = -18
                }
            } else if (keys.d.pressed) {
                player1.v.x = 5,
                    player1.attackBox.offset.x = 0
                if (keys.w.pressed && player1.position.y == pi || keys.w.pressed && Block({ ply: player1 })) {
                    keys.w.pressed = false
                    player1.v.y = -18
                }
            } else if (keys.w.pressed && player1.position.y == pi || keys.w.pressed && Block({ ply: player1 })) {
                keys.w.pressed = false
                player1.v.y = -18
            }

            if (keys.ArrowLeft.pressed) {
                player2.v.x = -5
                player2.attackBox.offset.x = -50
                if (keys.ArrowUp.pressed && player2.position.y == pi ||
                    keys.ArrowUp.pressed && Block({ ply: player2 })) {
                    keys.ArrowUp.pressed = false
                    player2.v.y = -18
                }
                if (keys.ArrowRight.pressed) {
                    player2.v.x = 0
                }
            } else if (keys.ArrowRight.pressed) {
                player2.v.x = 5
                player2.attackBox.offset.x = 0
                if (keys.ArrowUp.pressed && player2.position.y == pi ||
                    keys.ArrowUp.pressed && Block({ ply: player2 })) {
                    keys.ArrowUp.pressed = false
                    player2.v.y = -18
                }
            } else if (keys.ArrowUp.pressed && player2.position.y == pi ||
                keys.ArrowUp.pressed && Block({ ply: player2 })) {
                keys.ArrowUp.pressed = false
                player2.v.y = -18
            }

            if (
                Collision({
                    ply1: player1,
                    ply2: player2
                }) &&
                player1.isAtk) {
                player1.isAtk = false
                player2.color = 'yellow'
                player2.value -= 200
                setTimeout(() => {
                    return player2.color = 'blue'
                }, 650);
            } else if (
                Collision({
                    ply1: player2,
                    ply2: player1
                }) &&
                player2.isAtk) {
                player2.isAtk = false
                player1.color = 'yellow'
                player1.value -= 200
                setTimeout(() => {
                    return player1.color = 'green'
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
                    break
                case 'a':
                    keys.a.pressed = true
                    break
                case 'w':
                    keys.w.pressed = true
                    break
                case 'c':
                    player1.attack()
                    break

                //player2
                case 'ArrowRight':
                    keys.ArrowRight.pressed = true
                    break
                case 'ArrowLeft':
                    keys.ArrowLeft.pressed = true
                    break
                case 'ArrowUp':
                    keys.ArrowUp.pressed = true
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

        console.log()
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