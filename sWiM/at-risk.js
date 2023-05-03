//tutorial link video https://youtu.be/vyqbNFMDRGQ

const canvas = document.querySelector('canvas')
const user = document.getElementById('user').textContent
const c = canvas.getContext('2d')

canvas.width = 1366
canvas.height = 768

c.fillRect(0, 0, canvas.width, canvas.height);

const g = 1

class sprite {
    constructor({ position, imageSrc }) {
        this.position = position
        this.image = new Image()
        this.image.src = imageSrc
    }

    draw() {
        c.drawImage(this.image, this.position.x, this.position.y)
    }

    update() {
        this.draw()
    }
}

class Player{
    constructor({ position, v, color, offset}) {
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
        c.fillRect(canvas.width * 0.5 - 50, 768 * 0.7, 100, 20),
        c.fillRect(0, 768 * 0.5, canvas.width * 0.4, 20),
        c.fillRect(canvas.width * 0.6, 768 * 0.5, canvas.width * 0.4, 20)

        c.font = '23px Tahoma'
        c.fillStyle = '#b83dba'
        c.fillText(user, this.position.x, this.position.y - 30)
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

        if (this.position.y + this.height + this.v.y >= canvas.height - 64 ||
            768 * 0.7 + 20 >= this.position.y + this.height + this.v.y &&
            Block({ ply: this })) {
            this.v.y = 0
        } else this.v.y += g

        if (player1.position.x <= 0) {
            keys.a.pressed = false
            player1.v.x = 0
        }

        if (this.position.x + this.width > canvas.width - 2) {
            keys.d.pressed = false
            this.v.x = 0
        }

        if (player2.position.x + player2.width > canvas.width - 2) {
            keys.ArrowRight.pressed = false
            player2.v.x = 0
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

const player1 = new Player({
    position: {
        x: 0.2 * 1366,
        y: 768 - 170
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

const player2 = new Player({
    position: {
        x: 0.8 * 1366 - 50,
        y: 768 - 170
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

    s: {
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

var pi = 768 - 160
var p1 = 768 * 0.8

function Block({ ply }) {
    return (
        ply.position.y + ply.height + ply.v.y >= 768 * 0.7 &&
        ply.position.x + ply.width + ply.v.x <= 1366 * 0.5 + 100 &&
        1366 * 0.5 - 50 <= ply.position.x + ply.width + ply.v.x
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
    for (let j = 0; j * 64 < 1366; j++) {
        new sprite({
        position: {
            x: 64 * j,
            y: 768 - 64
        },
        imageSrc: 'https://raw.githubusercontent.com/thiagogluszczak/sWiM/main/sWiM/At_Risk/sprites/ground.png'
    }).update()
    }
    player1.update()
    player2.update()

    player1.v.x = 0
    player2.v.x = 0

    player2.money.position.x = 1366 - 100

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
    } else if (keys.s.pressed) {
        player1.height = 50
    } else if (keys.s.pressed == false) {
        player1.height = 96
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
        case 's':
            keys.s.pressed = true
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
        case 's':
            keys.s.pressed = false
            player1.position.y + 100
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
