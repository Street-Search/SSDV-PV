// function active() {
//     var element = document.getElementById("Ypoints");
//     element.classList.add("active");
// }
// function desactive() {
//     var element = document.getElementById("Ypoints");
//     element.classList.remove("active");
// }






  // YPOINTS

const divsYpoints = document.querySelectorAll(".Ypoints");

divsYpoints.forEach((divYpoints) => {
  divYpoints.addEventListener("click", () => {
    if (!divYpoints.classList.contains("active")) {
      divsYpoints.forEach((div) => {
        div.classList.remove("active");
      });
      divYpoints.classList.add("active");
    }
  });
});

document.addEventListener("click", (event) => {
  divsYpoints.forEach((divYpoints) => {
    if (!divYpoints.contains(event.target)) {
      divYpoints.classList.remove("active");
    }
  });
});

  // ERROR

function error() {
  alert("This page is unavailable.")
}