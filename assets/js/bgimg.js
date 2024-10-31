// Copyright (c) 2024 Quelopande
const images = ['/assets/media/bg-1.webp', '/assets/media/bg-2.webp', '/assets/media/bg-3.webp', '/assets/media/bg-4.webp']; // Seleccionador imágenes
const selectedImage = images[Math.floor(Math.random() * images.length)]; // Random Media (random algorithm: &1269722386639491215)
document.querySelector('.body').style.backgroundImage = `linear-gradient(0deg, rgba(0,0,0,0.6516981792717087) 1%, rgba(255,255,255,0) 100%), url(${selectedImage})`; // Add style gradient (ID: 1269722992200650895)
if (selectedImage === '/assets/media/bg-4.png') {
    document.querySelector('.body').style.backgroundImage = `linear-gradient(0deg, rgba(0,0,0,0.13629201680672265) 100%, rgba(255,255,255,0) 100%), url('/assets/media/bg-4.png')`; // Add style gradient 301009_UB
};