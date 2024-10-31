// Copyright (c) 2024 Quelopande
let icon = document.getElementById("icon");
let activate = document.getElementById("btn-activate");

activate.onclick = function(){
    document.body.classList.toggle("white-theme");
    if(document.body.classList.contains("white-theme")){
        icon.classList.remove("fa-moon");
        icon.classList.add("fa-sun");
    } else{
        icon.classList.remove("fa-sun");
        icon.classList.add("fa-moon");
    }
}