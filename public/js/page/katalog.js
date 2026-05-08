const cards = document.querySelectorAll(".products .card");
const details = document.getElementById("overlay-details");
const closeBtn = document.getElementById("closeBtn");

// buka modal
cards.forEach((card) => {
  card.addEventListener("click", () => {
    details.style.display = "flex";
  });
});

// tutup modal
if (closeBtn) {
  closeBtn.addEventListener("click", () => {
    details.style.display = "none";
  });
}

// active size
const sizes = document.querySelectorAll(".size-list span");

sizes.forEach((size) => {
  size.addEventListener("click", () => {
    sizes.forEach(s => s.classList.remove("active"));
    size.classList.add("active");
  });
});