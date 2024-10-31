// Copyright (c) 2024 Quelopande
const downloadBtn = document.querySelector(".download-btn");
const fileLink = "https://drive.google.com/u/1/uc?id=1VXYxSggZmcB9HjTaWiky6gKzknQh2BU4&export=download";

const initTimer = () => {
    if(downloadBtn.classList.contains("disable-timer")) {
        return location.href = fileLink;
    }
    let timer = downloadBtn.dataset.timer;
    downloadBtn.classList.add("timer");
    downloadBtn.innerHTML = `Tú descarga finalizará en <b>${timer}</b> segundos`;
    const initCounter = setInterval(() => {
        if(timer > 0) {
            timer--;
            return downloadBtn.innerHTML = `Tú descarga finalizará en <b>${timer}</b> segundos`;
        }
        clearInterval(initCounter);
        location.href = fileLink;
        downloadBtn.innerText = "Se están descargando los archivos";
        setTimeout(() => {
            downloadBtn.classList.replace("timer", "disable-timer");
            downloadBtn.innerHTML = `<span class="icon material-symbols-rounded">vertical_align_bottom</span>
                                     <span class="text">Descargar denuevo</span>`;
        }, 3000);
    }, 1000);
}
    
downloadBtn.addEventListener("click", initTimer);