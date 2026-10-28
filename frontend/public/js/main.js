// Filter boxes based on category
document.addEventListener("DOMContentLoaded", () => {
  const buttons = document.querySelectorAll(".filter-btn");
  const boxes = document.querySelectorAll("[data-box]");

  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const category = btn.dataset.category;

      // active state
      buttons.forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");

      boxes.forEach((box) => {
        const boxCat = box.dataset.box;

        if (category === "all" || boxCat === category) {
          box.classList.remove("hidden");
        } else {
          box.classList.add("hidden");
        }
      });
    });
  });
});
