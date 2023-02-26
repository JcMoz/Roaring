
var images = document.querySelectorAll('.slider img');

var slideInterval = setInterval(nextSlide, 5000);

function nextSlide() {
  var currentImage = document.querySelector('.slider img.active');
  var nextImage = currentImage.nextElementSibling || images[0];
  
  // Si la imagen actual es la primera imagen fija, simplemente cambia la clase a la siguiente imagen
  if (currentImage.classList.contains('fixed')) {
    currentImage.classList.remove('active');
    nextImage.classList.add('active');
  } else {
    currentImage.classList.remove('active');
    nextImage.classList.add('active');
    
    // Si la siguiente imagen es la primera imagen fija, añade la clase 'fixed' a esa imagen
    if (nextImage.classList.contains('fixed')) {
      nextImage.classList.add('fixed');
    }
  }
}

// Establece la primera imagen como fija y activa
images[0].classList.add('fixed');
images[0].classList.add('active');

// Espera a que la primera imagen termine de cargarse
images[0].addEventListener('load', function() {
  images[0].classList.add('active');
});