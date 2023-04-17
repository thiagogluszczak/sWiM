const canvas = document.querySelector('canvas')
        const c = canvas.getContext('2d')

        canvas.width = innerWidth
        canvas.height = innerHeight

        c.fillRect(0, 0, canvas.width, canvas.height);

        const gravity = 0.3

        class sprite {
            constructor({ position, velocity, height }) {
                this.position = position
                this.velocity = velocity
                this.height = 96
            }

            draw() {
                c.fillStyle = 'red'
                c.fillRect(this.position.x, this.position.y, 50, this.height)
            }

            update() {
                this.draw()

                this.position.x += this.velocity.x
                this.position.y += this.velocity.y

                if (this.position.y + this.height + this.velocity.y >= canvas.height) {
                    this.velocity.y = 0
                } else this.velocity.y += gravity
            }
        }


        const player1 = new sprite({
            position: {
                x: 0.2 * innerWidth,
                y: innerHeight - 106
            },
            velocity: {
                x: 0,
                y: 10
            }
        })

        player1.draw()

        const player2 = new sprite({
            position: {
                x: 0.8 * innerWidth - 50,
                y: innerHeight - 106
            },
            velocity: {
                x: 0,
                y: 10
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
            }
        }

        let lastKey

        function animate() {
            window.requestAnimationFrame(animate);
            c.fillStyle = 'black'
            c.fillRect(0, 0, canvas.width, canvas.height)
            player1.update()
            player2.update()

            player1.velocity.x = 0

            if (keys.a.pressed && lastKey === 'a') {
                player1.velocity.x = -5
            } else if (keys.d.pressed && lastKey === 'd') {
                player1.velocity.x = 5
            } else if (keys.w.pressed && lastKey === 'w' && player1.position.y > 0.5 * canvas.height) {
                player1.velocity.y = -7
            }
        }

        animate()

        window.addEventListener('keydown', () => {
            switch (event.key) {
                case 'd':
                    keys.d.pressed = true
                    lastKey = 'd'
                    break
                case 'a':
                    keys.a.pressed = true
                    lastKey = 'a'
                    break
                case 'w':
                    keys.w.pressed = true
                    lastKey = 'w'
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
            }
            console.log(event.key)
        })