// Copyright (c) 2024 Quelopande
let btnSections = document.querySelectorAll(".btn-section");
let ees = document.querySelectorAll(".fa-chevron-down");


btnSections.forEach((btn, index) => {
  let ee = ees[index];
  let h2 = btnSections[index];
  let clicked = false;
  
  btn.addEventListener("click", () => {
    let section = document.querySelector("#" + btn.getAttribute("data-section"));
    section.style.display = section.style.display === "none" ? "block" : "none";
    let allSection = document.querySelector("." + btn.getAttribute("data-section"));
    if (!clicked) {
      clicked = true;
      ee.style.transform = 'rotate(180deg)';
      section.style.fontWeight = "400";
      section.classList.toggle('active');
    } else {
      clicked = false;
      ee.style.transform = 'rotate(0deg)';
      section.style.fontWeight = "400";
      section.classList.remove('active');
    }
  });
});
