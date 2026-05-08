// NAVBAR
function toggleMenu() {
  const backdrop = document.getElementById("backdrop");
  const overlay = document.getElementById("overlay");
  const icon = document.getElementById("burger");

  backdrop.classList.toggle("active");
  overlay.classList.toggle("active");

  if (overlay.classList.contains("active")) {
    icon.src = "/assets/icon/icon-close-putih.svg";
  } else {
    icon.src = "/assets/icon/icon-burger.svg";
  }
}

// AUTO ACTIVE LINK NAVBAR
const link = document.querySelectorAll(".menu-desktop a, .menu-overlay a");

link.forEach(l => {
  if (l.href === window.location.href) {
    l.classList.add("active");
  }
});