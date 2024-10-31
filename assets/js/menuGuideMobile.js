// Copyright (c) 2024 Quelopande
const xMark = document.querySelector('.x-mark');
const lMark = document.querySelector('.fa-list');
const sidebar = document.querySelector('.sidebar');
const main = document.querySelector('.main');
const body = document.querySelector('.body');

lMark.addEventListener('click', () => {
    lMark.classList.toggle('none');
    xMark.classList.toggle('block');
    sidebar.style.display = "block";
    body.style.overflowY = "hidden";
});
xMark.addEventListener('click', () => {
    xMark.classList.remove('block')
    lMark.classList.remove('none');
    sidebar.style.display = "none";
    body.style.overflowY = "scroll";
});
if ($(window).width() < 837){
    main.addEventListener('click', () => {
        xMark.classList.remove('block')
        lMark.classList.remove('none');
        sidebar.style.display = "none";
        body.style.overflowY = "scroll";
    });
}