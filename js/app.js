// const allBoxes = document.querySelectorAll('.container-bar');

//   allBoxes.forEach(box => {

//     box.addEventListener('click', e => {
//       e.target.classList.toggle('active');
//     })

//   })


// /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
// function menubg() {
//     document.getElementById("show-nav").style.width = "50%";
//     document.getElementById("main").style.marginLeft = "50%";
//     document.getElementById("nav-a-cont").style.display = "flex";
//   }
  
//   /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
//   function closeNav() {
//     document.getElementById("show-nav").style.width = "0";
//     document.getElementById("main").style.marginLeft = "0";
//     document.getElementById("nav-a-cont").style.display = "none";
//     document.body.style.backgroundColor = "khaki";
//   }



    // SCROLE

// const container = document.createElement('body')
// window.addEventListener("scroll", () => {
//   const {scrollTop, scrollHeight, clientHeight} = document.documentElement;
//  console.log(scrollTop,clientHeight,scrollHeight);
//   if(scrollTop + clientHeight === scrollHeight) {
//     console.log("tamere");
//   }
// })





  // AUDIO

var x = document.getElementById("Audio"); 

function playAudio() { 
  x.play(); 
}


  //ANIMATION TRANSITION PAGES

  const linksTarget = document.querySelectorAll('.link-animated');

// définit la durée de l'animation (en millisecondes)
const TIME_ANIMATE = 800;

// pour chaque lien cible
linksTarget.forEach(linkTarget => {
  // ajoute un écouteur de clic
  linkTarget.addEventListener('click', function(event) {
    // annule le comportement par défaut du lien
    event.preventDefault();

    // ajoute une classe "active" sur le lien cliqué
    this.classList.add('active');

    // crée un élément de remplissage de cercle
    const fillCircle = document.createElement('div');
    fillCircle.classList.add('fill-circle');

    // ajoute l'élément de remplissage de cercle au corps de la page
    document.body.appendChild(fillCircle);

    // attend la fin de l'animation avant de charger la cible du lien
    setTimeout(() => {
      const href = this.getAttribute('href');
      window.location.href = href;

      // ajoute une classe "filled" au corps de la page
      document.body.classList.add('filled');

      // supprime l'élément de remplissage de cercle de la page
      document.body.removeChild(fillCircle);
    }, TIME_ANIMATE);
  });
});




//   // SIGN

// function sign1() {
//   window.location.href="sign/sign-in.html"
//   // x.play(); 
//   // alert("Vous n'êtes pas connecté")
// }
// function sign2() {
//   window.location.href="sign/sign-up.html"
//   // x.play(); 
//   // alert("Vous n'êtes pas connecté")
// }


  // ERROR

  function error() {
    alert("This page is unavailable.")
  }


  //VISITE CARD

  function addSuiveurToCard(cardId, suiveurClass) {
    const card = document.getElementById(cardId);
    const suiveur = card.querySelector('.' + suiveurClass);
    let isActive = false;
  
    function handleMouseEnter() {
        if (isActive) {
            suiveur.style.display = 'grid';
            document.addEventListener('mousemove', handleMouseMove);
        }
    }
  
    function handleMouseLeave() {
        document.removeEventListener('mousemove', handleMouseMove);
        suiveur.style.display = 'none';
    }
  
    function handleMouseMove(e) {
      const cardRect = card.getBoundingClientRect();
      const offsetX = event.clientX - cardRect.left;
      const offsetY = event.clientY - cardRect.top;
      suiveur.style.left = `${offsetX}px`;
      suiveur.style.top = `${offsetY}px`;
    }

    function handleClick() {
      isActive = !isActive;
      card.classList.toggle('active', isActive);
      if (isActive) {
          suiveur.style.display = 'grid';
          document.addEventListener('mousemove', handleMouseMove);
      } else {
          // deuxième clic
          if (!isActive && !isSecondClick) {
              isSecondClick = true;
              document.removeEventListener('mousemove', handleMouseMove);
          } else {
              // troisième clic
              isSecondClick = false;
              suiveur.style.display = 'none';
              document.removeEventListener('mousemove', handleMouseMove);
          }
      }
  }
  let isSecondClick = false;
  
  
    card.addEventListener('mouseenter', handleMouseEnter);
    card.addEventListener('mouseleave', handleMouseLeave);
    card.addEventListener('click', handleClick);
  }
  // Appeler la fonction pour chaque carte et chaque suiveur

addSuiveurToCard('card1', 'vc1');
addSuiveurToCard('card2', 'vc2');
addSuiveurToCard('card3', 'vc3');
  




  // BTNMM

  
  function btnMM() {
    var x = document.getElementById("cardMM");
    if (x.style.display === "flex") {
      x.style.display = "none";
    } else {
      x.style.display = "flex";
    }
  }



  // DESCRIPTION



// function btn1() {
//   document.getElementById("box-descr1").style.display = "flex";
//   document.getElementById("box-descr2").style.display = "none";
//   document.getElementById("box-descr3").style.display = "none";
//   document.getElementById("box-descr4").style.display = "none";
//   x.play();
// }
// function btn2() {
//   document.getElementById("box-descr1").style.display = "none";
//   document.getElementById("box-descr2").style.display = "flex";
//   document.getElementById("box-descr3").style.display = "none";
//   document.getElementById("box-descr4").style.display = "none";
//   x.play();
// }
// function btn3() {
//   document.getElementById("box-descr1").style.display = "none";
//   document.getElementById("box-descr2").style.display = "none";
//   document.getElementById("box-descr3").style.display = "flex";
//   document.getElementById("box-descr4").style.display = "none";
//   x.play();
// }
// function btn4() {
//   document.getElementById("box-descr1").style.display = "none";
//   document.getElementById("box-descr2").style.display = "none";
//   document.getElementById("box-descr3").style.display = "none";
//   document.getElementById("box-descr4").style.display = "flex";
//   x.play();
// }

function showElement(elementId) {
  document.getElementById("box-descr1").style.display = "none";
  document.getElementById("box-descr2").style.display = "none";
  document.getElementById("box-descr3").style.display = "none";
  document.getElementById("box-descr4").style.display = "none";
  document.getElementById(elementId).style.display = "flex";
  x.play();
}

function btn1() {
  showElement("box-descr1");
}

function btn2() {
  showElement("box-descr2");
}

function btn3() {
  showElement("box-descr3");
}

function btn4() {
  showElement("box-descr4");
}


// if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches){
//   alert('waw je suis en dark mode')
// }

//                                  3D