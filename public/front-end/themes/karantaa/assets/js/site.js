// ==================== Theme Toggle ====================
(function () {
  const toggles = [
    document.getElementById("brt-themeToggle"),
    document.getElementById("brt-themeToggleMobile"),
    document.getElementById("brt-themeToggleMenu"),
  ];
  const icons = [
    document.getElementById("brt-themeIcon"),
    document.getElementById("brt-themeIconMobile"),
    document.getElementById("brt-themeIconMenu"),
  ];
  const html = document.documentElement;

  function getPreferredTheme() {
    const stored = localStorage.getItem("karantaa-theme");
    if (stored) return stored;
    return window.matchMedia("(prefers-color-scheme: dark)").matches
      ? "dark"
      : "light";
  }

  function updateIcons(theme) {
    const iconClass = theme === "dark" ? "ri-sun-line" : "ri-moon-line";
    icons.forEach((icon) => {
      if (icon) icon.className = iconClass;
    });
  }

  const currentTheme = getPreferredTheme();
  html.setAttribute("data-bs-theme", currentTheme);
  updateIcons(currentTheme);

  function toggleTheme() {
    const theme = html.getAttribute("data-bs-theme");
    const next = theme === "light" ? "dark" : "light";
    html.setAttribute("data-bs-theme", next);
    localStorage.setItem("karantaa-theme", next);
    updateIcons(next);
  }

  toggles.forEach((t) => {
    if (t) t.addEventListener("click", toggleTheme);
  });

  window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", (e) => {
      if (!localStorage.getItem("karantaa-theme")) {
        const next = e.matches ? "dark" : "light";
        html.setAttribute("data-bs-theme", next);
        updateIcons(next);
      }
    });

  // ==================== Mobile nav: close on link click ====================
  document.addEventListener("DOMContentLoaded", function () {
    document
      .querySelectorAll(".navbar-nav .nav-link:not(.dropdown-toggle)")
      .forEach((link) => {
        link.addEventListener("click", () => {
          const navbarCollapse = document.getElementById("navbarContent");
          if (navbarCollapse && navbarCollapse.classList.contains("show")) {
            const bsCollapse =
              bootstrap.Collapse.getOrCreateInstance(navbarCollapse);
            bsCollapse.hide();
          }
        });
      });

    window.addEventListener("resize", function () {
      const navbarCollapse = document.getElementById("navbarContent");
      if (
        window.innerWidth >= 992 &&
        navbarCollapse &&
        navbarCollapse.classList.contains("show")
      ) {
        const bsCollapse =
          bootstrap.Collapse.getOrCreateInstance(navbarCollapse);
        bsCollapse.hide();
      }
    });
  });
})();

/* =====================================================================
   Hero Carousel — Vanilla JS
   Handles: auto-play, manual navigation, swipe, keyboard, pause on hover
   ===================================================================== */
(function () {
  "use strict";

  const carousel = document.getElementById("heroCarousel");
  if (!carousel) return;

  /* --- Elements --- */
  const slides = carousel.querySelectorAll(".slide");
  const dots = carousel.querySelectorAll(".brt-carousel-dot");
  const prevBtn = carousel.querySelector(".brt-carousel-arrow.prev");
  const nextBtn = carousel.querySelector(".brt-carousel-arrow.next");
  const totalSlides = slides.length;

  let currentIndex = 0;
  let autoPlayInterval = null;
  let isTransitioning = false;
  const autoPlayDelay = 6000; // ms

  /* --- Core: Go to specific slide --- */
  function goToSlide(index) {
    if (isTransitioning || index === currentIndex) return;
    isTransitioning = true;

    // Remove active from current
    slides[currentIndex].classList.remove("active");
    dots[currentIndex].classList.remove("active");

    // Set new index
    currentIndex = (index + totalSlides) % totalSlides;

    // Add active to new
    slides[currentIndex].classList.add("active");
    dots[currentIndex].classList.add("active");

    // Reset transition lock after animation completes
    setTimeout(function () {
      isTransitioning = false;
    }, 800);
  }

  function nextSlide() {
    goToSlide(currentIndex + 1);
  }

  function prevSlide() {
    goToSlide(currentIndex - 1);
  }

  /* --- Auto-play --- */
  function startAutoPlay() {
    stopAutoPlay();
    autoPlayInterval = setInterval(nextSlide, autoPlayDelay);
  }

  function stopAutoPlay() {
    if (autoPlayInterval) {
      clearInterval(autoPlayInterval);
      autoPlayInterval = null;
    }
  }

  /* --- Event: Arrow buttons --- */
  if (nextBtn) {
    nextBtn.addEventListener("click", function () {
      nextSlide();
      startAutoPlay(); // Reset timer after manual interaction
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener("click", function () {
      prevSlide();
      startAutoPlay();
    });
  }

  /* --- Event: Dot navigation --- */
  dots.forEach(function (dot) {
    dot.addEventListener("click", function () {
      var gotoIndex = parseInt(this.getAttribute("data-goto"), 10);
      goToSlide(gotoIndex);
      startAutoPlay();
    });
  });

  /* --- Event: Pause on hover --- */
  carousel.addEventListener("mouseenter", stopAutoPlay);
  carousel.addEventListener("mouseleave", startAutoPlay);

  /* --- Event: Keyboard navigation --- */
  document.addEventListener("keydown", function (e) {
    // Only respond if carousel is in viewport
    var rect = carousel.getBoundingClientRect();
    var inView = rect.top < window.innerHeight && rect.bottom > 0;
    if (!inView) return;

    if (e.key === "ArrowLeft") {
      prevSlide();
      startAutoPlay();
    } else if (e.key === "ArrowRight") {
      nextSlide();
      startAutoPlay();
    }
  });

  /* --- Touch / Swipe support --- */
  let touchStartX = 0;
  let touchEndX = 0;
  const swipeThreshold = 50;

  carousel.addEventListener(
    "touchstart",
    function (e) {
      touchStartX = e.changedTouches[0].screenX;
      stopAutoPlay();
    },
    { passive: true },
  );

  carousel.addEventListener(
    "touchend",
    function (e) {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
      startAutoPlay();
    },
    { passive: true },
  );

  function handleSwipe() {
    var diff = touchStartX - touchEndX;
    if (Math.abs(diff) < swipeThreshold) return;

    if (diff > 0) {
      // Swiped left → next
      nextSlide();
    } else {
      // Swiped right → prev
      prevSlide();
    }
  }

  /* --- Pause when tab is not visible --- */
  document.addEventListener("visibilitychange", function () {
    if (document.hidden) {
      stopAutoPlay();
    } else {
      startAutoPlay();
    }
  });

  /* --- Initialize --- */
  startAutoPlay();
})();
