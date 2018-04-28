window.requestAnimFrame = (callback => {
    return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        function (callback) {
            window.setTimeout(callback, 1000 / 60)
        };
})();

let canvasColor = '#429E46';
let canvas = document.querySelector('.connecting-dots');
const ctx = canvas.getContext('2d');
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

class Dot {
    constructor() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;

        this.vx = -.5 + Math.random();
        this.vy = -.5 + Math.random();

        this.radius = Math.random();
    }

    create() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
        ctx.fill();
        ctx.closePath();
    }

    static animate(dots) {
        for (let i = 0; i < dots.nb; i++) {
            let dot = dots.content[i];
            if (dot.y < 0 || dot.y > canvas.height) {
                dot.vx = dot.vx;
                dot.vy = -dot.vy;
            } else if (dot.x < 0 || dot.x > canvas.width) {
                dot.vx = -dot.vx;
                dot.vy = dot.vy;
            }
            dot.x += dot.vx;
            dot.y += dot.vy;
        }
    }

    static line(dots, mousePosition) {
        for (let i = 0; i < dots.nb; i++) {
            for (let j = 0; j < dots.nb; j++) {
                const i_dot = dots.content[i];
                const j_dot = dots.content[j];

                if ((i_dot.x - j_dot.x) < dots.distance && (i_dot.y - j_dot.y) < dots.distance && (i_dot.x - j_dot.x) > -dots.distance && (i_dot.y - j_dot.y) > -dots.distance) {
                    if ((i_dot.x - mousePosition.x) < dots.d_radius && (i_dot.y - mousePosition.y) < dots.d_radius && (i_dot.x - mousePosition.x) > -dots.d_radius && (i_dot.y - mousePosition.y) > -dots.d_radius) {
                        ctx.beginPath();
                        ctx.moveTo(i_dot.x, i_dot.y);
                        ctx.lineTo(j_dot.x, j_dot.y);
                        ctx.stroke();
                        ctx.closePath();
                    }
                }
            }
        }
    }
}

export function render() {
    ctx.lineWidth = .1;
    ctx.fillStyle = canvasColor;
    ctx.strokeStyle = canvasColor;

    let mousePosition = {
        x: 30 * canvas.width / 100,
        y: 30 * canvas.height / 100
    };

    let dots = {
        nb: 600,
        distance: 60,
        d_radius: 100,
        content: []
    };

    function createDots() {
        for (let i = 0; i < dots.nb; i++) {
            dots.content.push(new Dot());
        }
    }

    function loop() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let i = 0; i < dots.nb; i++) {
            dots.content[i].create();
        }
        Dot.line(dots, mousePosition);
        Dot.animate(dots);
        requestAnimationFrame(loop);
    }

    window.onmousemove = e => {
        mousePosition.x = e.x;
        mousePosition.y = e.y;
    };

    mousePosition.x = window.innerWidth / 2;
    mousePosition.y = window.innerHeight / 2;

    createDots();
    loop();
};