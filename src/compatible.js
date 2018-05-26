// In Edge 15 is not possible to use css variables in pseudo elements
if (navigator.userAgent.indexOf("Edge") > -1) {
    const body = document.querySelector("body");
    const style = document.querySelector("style");
    const color = getComputedStyle(body, ':root').getPropertyValue('--mdc-theme-primary');
    style.innerHTML += `::selection{background:${color}`;
}