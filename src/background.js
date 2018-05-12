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

const root = getComputedStyle(document.documentElement);
const canvasColor = root.getPropertyValue('--mdc-theme-primary').trim();
let canvas = document.querySelector('.connecting-dots');
const ctx = canvas.getContext('2d');

function draw() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    ctx.lineWidth = .1;
    ctx.fillStyle = canvasColor;
    ctx.strokeStyle = canvasColor;
}

window.addEventListener("resize", draw, false);

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
        dots.map(dot => {
            if (dot.y < 0 || dot.y > canvas.height) {
                dot.vx = dot.vx;
                dot.vy = -dot.vy;
            } else if (dot.x < 0 || dot.x > canvas.width) {
                dot.vx = -dot.vx;
                dot.vy = dot.vy;
            }
            dot.x += dot.vx;
            dot.y += dot.vy;
        });
    }

    static line(dots, mousePosition, distance = 60, radius = 100) {
        const dotsLength = dots.length;
        for (let i = 0; i < dotsLength; i++) {
            for (let j = 0; j < dotsLength; j++) {
                const iDot = dots[i];
                const jDot = dots[j];
                if ((iDot.x - jDot.x) < distance && (iDot.y - jDot.y) < distance && (iDot.x - jDot.x) > -distance && (iDot.y - jDot.y) > -distance) {
                    if ((iDot.x - mousePosition.x) < radius && (iDot.y - mousePosition.y) < radius && (iDot.x - mousePosition.x) > -radius && (iDot.y - mousePosition.y) > -radius) {
                        ctx.beginPath();
                        ctx.moveTo(iDot.x, iDot.y);
                        ctx.lineTo(jDot.x, jDot.y);
                        ctx.stroke();
                        ctx.closePath();
                    }
                }
            }

        }
    }
}

export function render() {
    draw();

    let mousePosition = {
        x: innerWidth / 2,
        y: innerHeight / 2
    };

    let dots = Array.from(Array(600)).map(() => new Dot());

    window.onmousemove = e => {
        mousePosition.x = e.x;
        mousePosition.y = e.y;
    };

    (function loop() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        dots.forEach(e => {
            e.create();
        });
        Dot.line(dots, mousePosition);
        Dot.animate(dots);
        requestAnimationFrame(loop);
    })()
};