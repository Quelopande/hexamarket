// Copyright (c) 2024 Quelopande
function search_container() {
    let input = document.getElementById('searchbar').value.toLowerCase();
    let x = document.getElementsByClassName('container');
    let found = false;
    for (let i = 1; i < x.length; i++) {
        let container = x[i];
        let tags = container.getElementsByClassName('tag');
        let tagsText = Array.from(tags).map(tag => tag.textContent.toLowerCase()).join(' ');

        if (!container.innerHTML.toLowerCase().includes(input) && !tagsText.includes(input)) {
            container.style.display = "none";
        } else {
            container.style.display = "flex";
            found = true;
        }
    }
    let notification = document.getElementById('notification');
    if (!found) {
        notification.classList.add('notification');
        notification.style.visibility = "visible";
        let errorInfo = document.querySelector('.error-info');
        errorInfo.innerHTML = ('There is no information for ' + '<b class="txt">' + document.getElementById('searchbar').value + '</b>');
    } else {
        notification.classList.remove('notification');
        notification.style.visibility = "hidden";
    }
}