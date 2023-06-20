//tutorial link video https://youtu.be/vyqbNFMDRGQ

const canvas = document.querySelector('canvas')
const user = document.getElementById('user').textContent
const c = canvas.getContext('2d')

canvas.width = 1366
canvas.height = 768

c.fillRect(0, 0, canvas.width, canvas.height);

const g = 1

class sprite {
    constructor({ pos, imageSrc }) {
        this.pos = pos
        this.image = new Image()
        this.image.src = imageSrc
    }

    draw() {
        c.drawImage(this.image, this.pos.x, this.pos.y)
    }

    update() {
        this.draw()
    }
}

class Player extends sprite {
    constructor({ pos, v, color, offset, imageSrc}) {
        super({
            pos,
            imageSrc
        })

        this.v = v
        this.width = 50
        this.height = 200
        this.attackBox = {
            pos: {
                x: this.pos.x,
                y: this.pos.y
            },
            offset,
            width: 100,
            height: 50
        }
        this.color = color
        this.money = {
            pos: {
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
        c.drawImage(this.image, this.pos.x - 75, this.pos.y, this.width + 150, this.height)

        c.fillStyle = 'orange'
        c.fillRect(canvas.width * 0.5 - 50, canvas.height * 0.7, 100, 20),
        c.fillRect(0, canvas.height * 0.5, canvas.width * 0.4, 20),
        c.fillRect(canvas.width * 0.6, canvas.height * 0.5, canvas.width * 0.4, 20)

        c.font = '23px Tahoma'
        c.fillStyle = '#b83dba'
        c.fillText(user, this.pos.x, this.pos.y - 30)
        c.fillText(this.value, this.pos.x, this.pos.y - 10)

        if (this.isAtk) {
            let atkColor;
            atkColor = 'rgba(142, 170, 30, 0.9)'
            c.fillStyle = atkColor
            c.fillRect(
                this.attackBox.pos.x,
                this.attackBox.pos.y,
                this.attackBox.width,
                this.attackBox.height
            )
        }

    }

    update() {
        this.draw()
        this.attackBox.pos.x = this.pos.x + this.attackBox.offset.x
        this.attackBox.pos.y = this.pos.y

        this.pos.x += this.v.x
        this.pos.y += this.v.y

        if (this.pos.y + this.height + this.v.y >= canvas.height - 64 ||
            canvas.height * 0.7 + 20 >= this.pos.y + this.height + this.v.y &&
            Block({ ply: this })) {
            this.v.y = 0
        } else this.v.y += g

        if (player1.pos.x <= 0) {
            keys.a.pressed = false
            player1.v.x = 0
        }

        if (this.pos.x + this.width > canvas.width - 2) {
            keys.d.pressed = false
            this.v.x = 0
        }

        if (player2.pos.x + player2.width > canvas.width - 2) {
            keys.ArrowRight.pressed = false
            player2.v.x = 0
        }

        if (this.pos.x <= 0) {
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
    pos: {
        x: 0.2 * canvas.width,
        y: canvas.height - 274
    },
    v: {
        x: 0,
        y: 10
    },
    color: 'green',
    offset: {
        x: 0,
        y: 100
    },
    imageSrc: './At_Risk/sprites/blett_stand(0).png'
})

player1.draw()

const player2 = new Player({
    pos: {
        x: 0.8 * canvas.width - 50,
        y: canvas.height - 274
    },
    v: {
        x: 0,
        y: 10
    },
    color: 'blue',
    offset: {
        x: -50,
        y: 0
    },
    imageSrc: ""
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

var pi = canvas.height - 264
var p1 = canvas.height * 0.8

function Block({ ply }) {
    return (
        ply.pos.y + ply.height + ply.v.y >= canvas.height * 0.7 &&
        ply.pos.x + ply.width + ply.v.x <= canvas.width * 0.5 + 100 &&
        canvas.width * 0.5 - 50 <= ply.pos.x + ply.width + ply.v.x
    )
}

function Collision({ ply1, ply2 }) {
    return (
        ply1.attackBox.pos.x + ply1.attackBox.width >= ply2.pos.x &&
        ply1.attackBox.pos.x <= ply2.pos.x + ply2.width &&
        ply1.attackBox.pos.y + ply1.attackBox.height >= ply2.pos.y &&
        ply1.attackBox.pos.y <= ply2.pos.y + ply2.height &&
        ply1.isAtk)
}

function animate() {
    window.requestAnimationFrame(animate);
    c.fillStyle = '#990000'
    c.fillRect(0, 0, canvas.width, canvas.height)
    for (let j = 0; j < 23; j++) {
        new sprite({
            pos: {
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

    player2.money.pos.x = canvas.width - 100

    if (keys.a.pressed) {
        player1.v.x = -5
        if (keys.d.pressed) {
            player1.v.x = 0
        }
        if (keys.w.pressed && player1.pos.y == pi || keys.w.pressed && Block({ ply: player1 })) {
            keys.w.pressed = false
            player1.v.y = -18
        }
    } else if (keys.d.pressed) {
        player1.v.x = 5
        if (keys.w.pressed && player1.pos.y == pi || keys.w.pressed && Block({ ply: player1 })) {
            keys.w.pressed = false
            player1.v.y = -18
        }
    } else if (keys.w.pressed && player1.pos.y == pi || keys.w.pressed && Block({ ply: player1 })) {
        keys.w.pressed = false
        player1.v.y = -18
    }

    if (keys.ArrowLeft.pressed) {
        player2.v.x = -5
        player2.attackBox.offset.x = -50
        if (keys.ArrowUp.pressed && player2.pos.y == pi ||
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
        if (keys.ArrowUp.pressed && player2.pos.y == pi ||
            keys.ArrowUp.pressed && Block({ ply: player2 })) {
            keys.ArrowUp.pressed = false
            player2.v.y = -18
        }
    } else if (keys.ArrowUp.pressed && player2.pos.y == pi ||
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
        if(player1.value <= 0){
            player1.color = 'red'
        } else {
            setTimeout(() => {
            return player1.color = 'green'
        }, 650);
        }
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
            player1.attackBox.width = 100
            if (keys.a.pressed) {
                player1.attackBox.offset.x = -50
            } else if(keys.d.pressed) {
                player1.attackBox.offset.x = 0
            }
            player1.attackBox.color = 'red'
            break
        case 'v':
            player1.attack()
            player1.attackBox.width = 500
            if (keys.a.pressed) {
                player1.attackBox.offset.x = -450
            } else if(keys.d.pressed) {
                player1.attackBox.offset.x = 0
            }
            player1.attackBox.color = 'red'
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
