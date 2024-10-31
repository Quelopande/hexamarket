// Copyright (c) 2024 Quelopande
function enlargeImage(src) {
    var overlay = document.querySelector('.overlay');
    var imgEnlarged = document.createElement('img');
    imgEnlarged.src = src;
    imgEnlarged.classList.add('img-enlarged');
    overlay.appendChild(imgEnlarged);
    overlay.style.display = 'block';
}
function closeImage() {
    var overlay = document.querySelector('.overlay');
    var imgEnlarged = document.querySelector('.img-enlarged');
    overlay.removeChild(imgEnlarged);
    overlay.style.display = 'none';
}