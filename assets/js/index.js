let menu = document.querySelector('.menu');
let menuBtn = document.querySelector('.menu button');
    menuBtn.addEventListener('click', () => {
    menu.classList.toggle('opened')
})

document.querySelector('.cta').addEventListener('click', () => {
    window.location.href = 'views/signup.html'
})

document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;

    themeToggle.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
    });
});
