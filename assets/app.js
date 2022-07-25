/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

// Default theme
import '@splidejs/splide/css';


require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');
// app.js

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

/* Bouton UP */
var btn = $('#up');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '200');
});




// let brands = document.getElementById('brands');
// let brandsFilter = document.getElementsByClassName('brands-filter');

// brands.addEventListener("click", () => {

//   if(getComputedStyle(brandsFilter).display != "none") {
//       brandsFilter.style.display = "none";
//   } else {
//       brandsFilter.style.display = "block";
//   }
// }); 


/* Sous-menu dans filtres */
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});


// /* Affichage selon taille écran */

// let width = screen.width;
// let navbar = document.getElementsByClassName('navbar')

// if (width >= 768) {
//   navbar.style.display = 'none';
// } else {
//   navbar.style.display = 'flex';
// }


/* /CAR/ID */
let detailsBtn = document.getElementById('details-btn');
let detailsDesc = document.getElementById('details-desc');

if (detailsBtn) {
  detailsBtn.addEventListener("click", () => {
      if (getComputedStyle(detailsDesc).display != "none") {
          detailsDesc.style.display = "none";
      } else {
          detailsDesc.style.display = "block";
      }
  })
  
}


// Slider - home 


