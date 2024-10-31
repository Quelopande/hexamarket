// Copyright (c) 2024 Quelopande
const menu = document.querySelector('[data-menu="menu1"]');
const subMenu = document.querySelector('.menu1');
const i1 = document.querySelector('.i1');
const i = document.querySelector('.i');
const menu2 = document.querySelector('[data-menu="menu2"]');
const subMenu2 = document.querySelector('.menu2');
const i2 = document.querySelector('.i2');
const menu3 = document.querySelector('[data-menu="menu3"]');
const subMenu3 = document.querySelector('.menu3');
const i3 = document.querySelector('.i3');
const menu4 = document.querySelector('[data-menu="menu4"]');
const subMenu4 = document.querySelector('.menu4');
const i4 = document.querySelector('.i4');
const menu5 = document.querySelector('[data-menu="menu5"]');
const subMenu5 = document.querySelector('.menu5');
const i5 = document.querySelector('.i5');
const menu6 = document.querySelector('[data-menu="menu6"]');
const subMenu6 = document.querySelector('.menu6');
const i6 = document.querySelector('.i6');
const menu7 = document.querySelector('[data-menu="menu7"]');
const subMenu7 = document.querySelector('.menu7');
const i7 = document.querySelector('.i7');
const menu8 = document.querySelector('[data-menu="menu8"]');
const subMenu8 = document.querySelector('.menu8');
const i8 = document.querySelector('.i8');
const color1 = '#c0c0c04d';
const color2 = 'white';

menu.addEventListener('click', () => {
    subMenu.classList.toggle('show');
    menu.classList.toggle('toggled');
    i1.classList.toggle('i');
});
menu2.addEventListener('click', () => {
    subMenu2.classList.toggle('show');
    menu2.classList.toggle('toggled');
    i2.classList.toggle('i');
});

menu3.addEventListener('click', () => {
    subMenu3.classList.toggle('show');
    menu3.classList.toggle('toggled');
    i3.classList.toggle('i');
});
menu4.addEventListener('click', () => {
    subMenu4.classList.toggle('show');
    menu4.classList.toggle('toggled');
    i4.classList.toggle('i');
});
menu5.addEventListener('click', () => {
    subMenu5.classList.toggle('show');
    menu5.classList.toggle('toggled');
    i5.classList.toggle('i');
});

menu6.addEventListener('click', () => {
    subMenu6.classList.toggle('show');
    menu6.classList.toggle('toggled');
    i6.classList.toggle('i');
});

menu7.addEventListener('click', () => {
    subMenu7.classList.toggle('show');
    menu7.classList.toggle('toggled');
    i7.classList.toggle('i');
});

menu8.addEventListener('click', () => {
    subMenu8.classList.toggle('show');
    menu8.classList.toggle('toggled');
    i8.classList.toggle('i');
});