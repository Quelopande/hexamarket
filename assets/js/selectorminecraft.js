// Copyright (c) 2024 Quelopande
function showcontent(selector) {
    let plugins = document.getElementById("plugins");
    let maps = document.getElementById("maps");
    let skins = document.getElementById("skins");
    let mods = document.getElementById("mods");
    let mskins = document.getElementById("mskins");
    let dpacks = document.getElementById("dpacks");
    let blogs = document.getElementById("blogs");
    
  
    if (selector === "no") {
      console.log('all the content display');
      plugins.style.display = "block";
      maps.style.display = "block";
      skins.style.display = "block";
      mods.style.display = "block";
      mskins.style.display = "block";
      dpacks.style.display = "block";
      blogs.style.display = "block";
    } else if (selector === "plugins") {
        plugins.style.display = "block";
        console.log('Plugins displayed');
    }else if (selector === "maps") {
        maps.style.display = "block";
        console.log('maps displayed');
    }else if (selector === "skins") {
        skins.style.display = "block";
        console.log('Player skins displayed');
    }else if (selector === "mods") {
        mods.style.display = "block";
        console.log('mods displayed');
    } else if (selector === "mskins") {
        mskins.style.display = "block";
        console.log('Mob skins displayed');
    } else if (selector === "dpacks") {
        dpacks.style.display = "block";
        console.log('Data packs displayed');
    } else if (selector === "blogs") {
        blogs.style.display = "block";
        console.log('Blogs packs displayed');
    } else{
        console.log('all the content display');
      plugins.style.display = "block";
      maps.style.display = "block";
      skins.style.display = "block";
      mods.style.display = "block";
      mskins.style.display = "block";
      dpacks.style.display = "block";
      blogs.style.display = "block";
    }

    let newURL = new URL(window.location.href);
    newURL.searchParams.set('cat', selector);
    history.pushState({ selector: selector }, '', newURL.toString());
  }
    let urlParams = new URLSearchParams(window.location.search);
    let initialCategory = urlParams.get('cat');
    if (initialCategory) {
    showcontent(initialCategory);
    }
    let selector = document.getElementById("selectorContenido");
    selector.addEventListener("change", function() {
        let selection = this.value;
        showcontent(selection);
    });
// Código inservible descartado, se prefiere usar php 1014931210981613568