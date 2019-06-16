let goTop = document.querySelector('#goTop');
let showGoTop = false;
window.addEventListener('scroll', e => {
    const top = document.body.scrollTop | document.documentElement.scrollTop;
    if (top > 600 && !showGoTop) {
        goTop.classList.remove('fab-hidden');
        showGoTop = true;
    } else if (top < 600 && showGoTop) {
        goTop.classList.add('fab-hidden');
        showGoTop = false;
    }
});

function scrollTop(duration = 30) {
    let stepCount = 0;
    const initialPosition = scrollY;
    const stepPI = Math.PI / duration;
    requestAnimationFrame(step);

    function step() {
        if (stepCount < duration) {
            requestAnimationFrame(step);
            stepCount++;
            window.scrollTo(0, initialPosition * (1 - 0.25 * Math.pow((1 - Math.cos(stepPI * stepCount)), 2)));
        }
    }
}

goTop.addEventListener("click", e => {
    e.preventDefault();
    scrollTop();
})