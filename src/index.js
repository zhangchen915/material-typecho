import 'prismjs'
import 'prismjs/components/prism-typescript'
import 'prismjs/components/prism-json'
import 'prismjs/components/prism-python'
import 'prismjs/components/prism-java'


import { MDCRipple } from '@material/ripple/index'

import './index.scss'
import '../node_modules/prismjs/themes/prism.css'

const $ = document.querySelector;

document.querySelectorAll('.mdc-button').forEach(e => {
    MDCRipple.attachTo(e);
})

window.requestAnimFrame = (function (callback) {
    return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        function (callback) {
            window.setTimeout(callback, 1000 / 60);
        };
})();

var goTop = $('#goTop');
var canvas = $('.connecting-dots');
var canvasColor = '#429E46';
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;
ctx = canvas.getContext('2d');

var display = false;
window.addEventListener('scroll', function (e) {
    var top = document.body.scrollTop | document.documentElement.scrollTop;
    if (top > 200 && !display) {
        Velocity(goTop, "stop");
        Velocity(goTop, { bottom: 95 }, { duration: 300 }, { easing: "easeInSine" });
        display = true;
    } else if (top < 200 && display) {
        Velocity(goTop, "stop");
        Velocity(goTop, { bottom: -40 }, { duration: 300 }, { easing: "easeInSine" });
        display = false;
    }
});

goTop.addEventListener("click", function () {
    Velocity($('html'), "scroll", { duration: 500 }, { easing: "easeInSine" });
})

function canvasDots() {
    ctx.lineWidth = .1;
    ctx.fillStyle = canvasColor;
    ctx.strokeStyle = canvasColor;

    var mousePosition = {
        x: 30 * canvas.width / 100,
        y: 30 * canvas.height / 100
    };

    var dots = {
        nb: 600,
        distance: 60,
        d_radius: 100,
        array: []
    };

    function Dot() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;

        this.vx = -.5 + Math.random();
        this.vy = -.5 + Math.random();

        this.radius = Math.random();
    }

    Dot.prototype = {
        create: function () {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
            ctx.fill();
            ctx.closePath();
        },

        animate: function () {
            for (i = 0; i < dots.nb; i++) {

                var dot = dots.array[i];

                if (dot.y < 0 || dot.y > canvas.height) {
                    dot.vx = dot.vx;
                    dot.vy = - dot.vy;
                }
                else if (dot.x < 0 || dot.x > canvas.width) {
                    dot.vx = - dot.vx;
                    dot.vy = dot.vy;
                }
                dot.x += dot.vx;
                dot.y += dot.vy;
            }
        },

        line: function () {
            for (i = 0; i < dots.nb; i++) {
                for (j = 0; j < dots.nb; j++) {
                    i_dot = dots.array[i];
                    j_dot = dots.array[j];

                    if ((i_dot.x - j_dot.x) < dots.distance && (i_dot.y - j_dot.y) < dots.distance && (i_dot.x - j_dot.x) > - dots.distance && (i_dot.y - j_dot.y) > - dots.distance) {
                        if ((i_dot.x - mousePosition.x) < dots.d_radius && (i_dot.y - mousePosition.y) < dots.d_radius && (i_dot.x - mousePosition.x) > - dots.d_radius && (i_dot.y - mousePosition.y) > - dots.d_radius) {
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
    };

    function createDots() {
        for (i = 0; i < dots.nb; i++) {
            dots.array.push(new Dot());
        }
    }

    function loop() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        for (i = 0; i < dots.nb; i++) {
            dot = dots.array[i];
            dot.create();
        }
        dot.line();
        dot.animate();
        requestAnimationFrame(loop);
    }

    window.onmousemove = function (e) {
        mousePosition.x = e.x;
        mousePosition.y = e.y;
    };

    mousePosition.x = window.innerWidth / 2;
    mousePosition.y = window.innerHeight / 2;

    createDots();
    loop();
};

window.onload = function () {
    if (!navigator.userAgent.match(/AppleWebKit.*Mobile.*/)) {
        canvasDots();
    }
};