// HOME //

/* MENU */ 

let burger = document.getElementById('menu-burger');
let menu = document.getElementById('menu');
let itemAccess = document.getElementById('access-item');
let menuAccess = document.getElementById('access-menu');
let itemPdt = document.getElementById('product-item');
let menuPdt = document.getElementById('product-menu');
let itemSvc = document.getElementById('svc-item');
let menuSvc = document.getElementById('service-menu');

burger.addEventListener("click", () => {

    if(getComputedStyle(menu).display != "none") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}); 

itemAccess.addEventListener("click", () => {
    if (getComputedStyle(menuAccess).display != "none") {
        menuAccess.style.display = "none";
    } else {
        menuAccess.style.display = "block";
    }

})

itemPdt.addEventListener("click", () => {
    if (getComputedStyle(menuPdt).display != "none") {
        menuPdt.style.display = "none";
    } else {
        menuPdt.style.display = "block";
    }

})

itemSvc.addEventListener("click", () => {
    if (getComputedStyle(menuSvc).display != "none") {
        menuSvc.style.display = "none";
        menu.style.height = "38vh";
    } else {
        menuSvc.style.display = "block";
        menu.style.height = "45vh";
    }

})

/* USER INFO */

let userIcon = document.getElementById('user-icon');
let infoLog = document.getElementById('info-log');

userIcon.addEventListener("click", () => {
    if (getComputedStyle(infoLog).display != "none") {
        infoLog.style.display = "none";
    } else {
        infoLog.style.display = "block";
    }

})


// CARS PAGE //

/* /CAR */

let pdtSelect = document.getElementsByClassName('pdt-select');
let pdtDesc = document.getElementsByClassName('pdt-desc');

for (let i = 0; i < pdtSelect.length; i++) {
    pdtSelect[i].addEventListener('mouseover', () => {
        pdtDesc[i].style.display = 'block';
    })
    pdtSelect[i].addEventListener('mouseout', () => {
        pdtDesc[i].style.display = 'none';
    })
}


/* /CAR/ID */
let detailsBtn = document.getElementById('details-btn');
let detailsDesc = document.getElementById('details-desc');

detailsBtn.addEventListener("click", () => {
    if (getComputedStyle(detailsDesc).display != "none") {
        detailsDesc.style.display = "none";
    } else {
        detailsDesc.style.display = "block";
    }
})

