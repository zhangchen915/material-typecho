let goTop = document.querySelector('#goTop');
let showGoTop = false;
window.addEventListener('scroll', e => {
    const top = document.body.scrollTop | document.documentElement.scrollTop;
    if (top > 200 && !showGoTop) {
        goTop.className = '';
        showGoTop = true;
    } else if (top < 200 && showGoTop) {
        goTop.className = 'mbtop';
        showGoTop = false;
    }
});

function animateScroll(targetHeight) {
    targetHeight = document.body.scrollHeight - window.innerHeight > targetHeight + scrollY ?
        targetHeight : document.body.scrollHeight - window.innerHeight;
    var initialPosition = window.scrollY;
    var SCROLL_DURATION = 30;
    var step_x = Math.PI / SCROLL_DURATION;
    var step_count = 0;
    requestAnimationFrame(step);

    function step() {
        if (step_count < SCROLL_DURATION) {
            requestAnimationFrame(step);
            step_count++;
            window.scrollTo(0, initialPosition + targetHeight * 0.25 * Math.pow((1 - Math.cos(step_x * step_count)), 2));
        }
    }
}

goTop.addEventListener("click", e => {
    e.preventDefault();
    var target = document.body.getBoundingClientRect().top;
    animateScroll(target);
})