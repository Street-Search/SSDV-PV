//Friends select
function addActiveClass(event) {
  // Supprime la classe "active" de tous les éléments <li> qui ont la classe "friend"
  let friendElements = document.querySelectorAll('.friend');
  for (let i = 0; i < friendElements.length; i++) {
    friendElements[i].classList.remove('active');
  }
  // Ajoute la classe "active" à l'élément <li> qui a été cliqué
  event.currentTarget.classList.add('active');
}

//BG MENU

const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const menuCloseBtn = document.querySelector('.menu-close-btn');

let menuOpen = false;

menuBtn.addEventListener('click', () => {
  if (!menuOpen) {
    menuBtn.classList.add('open');
    menu.classList.add('active');
    menuOpen = true;
  } else {
    menuBtn.classList.remove('open');
    menu.classList.remove('active');
    menuOpen = false;
  }
});

menuCloseBtn.addEventListener('click', () => {
  menuBtn.classList.remove('open');
  menu.classList.remove('active');
  menuOpen = false;
});





// ASIDE UP - DOWN
const aside = document.querySelector('aside');
const asideUp = document.querySelector('.asideUp');
const asideDown = document.querySelector('.asideDown');

asideUp.addEventListener('click', () => {
aside.classList.add('retracted');
asideUp.style.display = 'none';
asideDown.style.display = 'block';
});

asideDown.addEventListener('click', () => {
aside.classList.remove('retracted');
asideUp.style.display = 'block';
asideDown.style.display = 'none';
});

function checkWindowSize() {
  if (window.innerWidth > 770) {
    aside.classList.remove('retracted');
    asideUp.style.display = 'none';
    asideDown.style.display = 'none';
  } else {
    asideUp.style.display = 'block';
  }
}

window.addEventListener('resize', checkWindowSize);

  

//INPUTE TEXT
// const inputBox = document.getElementById("input-box");

// inputBox.addEventListener("keydown", function(e) {
//   if (e.key === "Enter" && e.shiftKey) {
//     this.value += "\n";
//     this.style.height = "auto";
//     this.style.height = this.scrollHeight + "px";
//     e.preventDefault();
//   }
// });




//SEND MESSAGE

const inputBox = document.querySelector('#input-box');
const sendBox = document.querySelector('.send');
const footer = document.querySelector('footer');

// Fonction pour agrandir la zone de saisie
function expand() {
  // Mesure la hauteur du contenu actuel de la zone de saisie
  const currentHeight = inputBox.clientHeight;

  // Fixe la hauteur minimale à 36px (la hauteur initiale)
  sendBox.style.minHeight = '60px';
  footer.style.minHeight = '60px';

  // Fixe la hauteur maximale à 150px (par exemple)
  sendBox.style.maxHeight = '150px';
  footer.style.maxHeight = '150px';

  // Calcule la nouvelle hauteur de la zone de saisie en fonction du contenu tapé par l'utilisateur
  const newHeight = inputBox.scrollHeight;

  // Si la nouvelle hauteur est supérieure à la hauteur actuelle, agrandit la zone de saisie
  if (newHeight > currentHeight) {
    sendBox.style.height = `${newHeight}px`;
    footer.style.height = `${newHeight}px`;
  }
}

// Fonction pour rétrécir la zone de saisie
function contract() {
  sendBox.style.height = '60px';
  footer.style.height = '60px';
}

// Événement pour agrandir la zone de saisie lorsque l'utilisateur tape du texte
sendBox.addEventListener('input', function() {
  expand();
});

// Événement pour rétrécir la zone de saisie lorsque l'utilisateur supprime du texte
inputBox.addEventListener('keydown', function(e) {
  if (e.code === 'Backspace' && inputBox.value.length === 1) {
    contract();
  }
});

// Événement pour envoyer le message lorsque l'utilisateur appuie sur Entrée
inputBox.addEventListener('keydown', function(e) {
  if (e.code === 'Enter' && !e.shiftKey) {
    e.preventDefault();
    const message = inputBox.value.trim();
    if (message !== '') {
      // Insérer ici le code pour envoyer le message
      inputBox.value = '';
      contract();
    }
  }
});



