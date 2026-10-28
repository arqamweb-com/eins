// Exit Pop-up: shows a discount to visitors with items in the cart when they try to leave / go back
(() => {
  const popup = document.getElementById("eins-exit-popup");
  if (!popup || typeof einsExitPopup === "undefined") return;

  const HIDE_KEY = "einsExitHideUntil";
  const SHOWN_KEY = "einsExitShown";
  const isTouch = window.matchMedia("(pointer: coarse)").matches;
  const itemsBox = popup.querySelector("[data-eins-exit-items]");

  let armed = false;
  let backTrapSet = false;

  const isSuppressed = () => {
    try {
      if (sessionStorage.getItem(SHOWN_KEY)) return true;
      return Date.now() < Number(localStorage.getItem(HIDE_KEY) || 0);
    } catch (e) {
      return false;
    }
  };

  const hasCartCookie = () =>
    /(?:^|;\s*)woocommerce_items_in_cart=1/.test(document.cookie);

  // المحتوى بيتجاب بـ AJAX عشان الصفحات المتكاشة
  const loadCart = () => {
    if (isSuppressed()) return;

    fetch(einsExitPopup.endpoint, { credentials: "same-origin" })
      .then((res) => res.json())
      .then((res) => {
        if (!res.success || !res.data.count) {
          armed = false;
          return;
        }
        itemsBox.innerHTML = res.data.html;
        arm();
      })
      .catch(() => {});
  };

  const arm = () => {
    armed = true;

    // Mobile: أول Back بيفتح البوب أب بدل ما يخرج
    if (isTouch && !backTrapSet) {
      history.pushState({ einsExit: true }, "");
      backTrapSet = true;
    }
  };

  const open = () => {
    if (!armed || isSuppressed()) return;

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

  // Desktop: الماوس خرج من فوق الصفحة (ناحية التابات / Back / قفل)
  document.addEventListener("mouseout", (e) => {
    if (isTouch || e.relatedTarget || e.clientY > 0) return;
    open();
  });

  // Mobile: زرار الـ Back
  window.addEventListener("popstate", () => {
    if (!backTrapSet) return;
    backTrapSet = false;

    // لو السلة فضيت أو البوب أب اتقفل قبل كده، كمّل الـ Back عادي
    if (!armed || isSuppressed()) {
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

  // WooCommerce AJAX add / remove
  if (window.jQuery) {
    jQuery(document.body).on("added_to_cart removed_from_cart", loadCart);
  }

  if (hasCartCookie()) loadCart();
})();
