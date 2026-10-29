// Offer Pop-up: reminder of the current offer, after a delay or when the visitor tries to leave / go back
(() => {
  const popup = document.getElementById("eins-exit-popup");
  if (!popup || typeof einsExitPopup === "undefined") return;

  const HIDE_KEY = "einsExitHideUntil";
  const SHOWN_KEY = "einsExitShown";
  const isTouch = window.matchMedia("(pointer: coarse)").matches;

  let backTrapSet = false;

  const isSuppressed = () => {
    try {
      if (sessionStorage.getItem(SHOWN_KEY)) return true;
      return Date.now() < Number(localStorage.getItem(HIDE_KEY) || 0);
    } catch (e) {
      return false;
    }
  };

  if (isSuppressed()) return;

  const open = () => {
    if (isSuppressed()) return;

    try {
      sessionStorage.setItem(SHOWN_KEY, "1");
    } catch (e) {}

    popup.hidden = false;
    requestAnimationFrame(() => popup.classList.add("is-open"));
    popup.querySelector(".eins-exit-close").focus();
  };

  const close = () => {
    popup.classList.remove("is-open");
    setTimeout(() => (popup.hidden = true), 300);

    const days = Number(einsExitPopup.days) || 0;
    if (days > 0) {
      try {
        localStorage.setItem(HIDE_KEY, String(Date.now() + days * 864e5));
      } catch (e) {}
    }
  };

  // بعد عدد ثواني من الـ Customizer
  const delay = Number(einsExitPopup.delay) || 0;
  if (delay > 0) setTimeout(open, delay * 1000);

  // Desktop: الماوس خرج من فوق الصفحة (ناحية التابات / Back / قفل)
  document.addEventListener("mouseout", (e) => {
    if (isTouch || e.relatedTarget || e.clientY > 0) return;
    open();
  });

  // Mobile: أول Back بيفتح البوب أب بدل ما يخرج
  if (isTouch) {
    history.pushState({ einsExit: true }, "");
    backTrapSet = true;
  }

  window.addEventListener("popstate", () => {
    if (!backTrapSet) return;
    backTrapSet = false;

    // لو البوب أب ظهر قبل كده، كمّل الـ Back عادي
    if (isSuppressed()) {
      history.back();
      return;
    }
    open();
  });

  popup.querySelectorAll("[data-eins-exit-close]").forEach((btn) =>
    btn.addEventListener("click", close)
  );
  popup.addEventListener("click", (e) => {
    if (e.target === popup) close();
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !popup.hidden) close();
  });
})();
