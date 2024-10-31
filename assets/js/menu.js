// Copyright (c) 2024 Quelopande
let menu = document.getElementsByClassName('links')[0];
let openBtn = document.getElementsByClassName('.dropdown')[0];
openBtn.addEventListener("click", function() {
  menu.style.maxHeight = "3000px";
});