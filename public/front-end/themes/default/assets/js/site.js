/**
 * Scroll to Top Button and Smooth Navigation
 */
document.addEventListener("DOMContentLoaded", function () {
  const scrollToTopBtn = document.getElementById("scrollToTop");

  window.addEventListener("scroll", function () {
    if (window.pageYOffset > 300) {
      scrollToTopBtn.classList.add("active");
    } else {
      scrollToTopBtn.classList.remove("active");
    }
  });

  scrollToTopBtn.addEventListener("click", function (e) {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();

      const targetId = this.getAttribute("href");
      if (targetId === "#") return;

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        const offset = 70;
        const targetPosition =
          targetElement.getBoundingClientRect().top +
          window.pageYOffset -
          offset;

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });

        document.querySelectorAll(".nav-link").forEach((link) => {
          link.classList.remove("active");
        });
        this.classList.add("active");
      }
    });
  });

  /**
   * Active Section Highlighting
   */
  const sections = document.querySelectorAll("section");
  const navItems = document.querySelectorAll(".nav-link");

  window.addEventListener("scroll", function () {
    let current = "";

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      if (pageYOffset >= sectionTop - 100) {
        current = section.getAttribute("id");
      }
    });

    navItems.forEach((item) => {
      item.classList.remove("active");
      if (item.getAttribute("href") === `#${current}`) {
        item.classList.add("active");
      }
    });
  });

  /**
   * Pricing Card Highlight
   */
  const pricingCards = document.querySelectorAll(".pricing-card");
  pricingCards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      pricingCards.forEach((c) => c.classList.remove("highlight"));
      this.classList.add("highlight");
    });

    card.addEventListener("mouseleave", function () {
      this.classList.remove("highlight");
    });
  });

  /**
   * Testimonial Carousel (Bootstrap)
   */
  const testimonialCarousel = document.getElementById("testimonialCarousel");
  if (testimonialCarousel) {
    new bootstrap.Carousel(testimonialCarousel, {
      interval: 5000,
      pause: "hover",
    });
  }
});

/**
 * Animated Counters
 */
document.addEventListener("DOMContentLoaded", function () {
  const counters = document.querySelectorAll(".counter");
  const speed = 200;
  let animated = false;

  function animateCounters() {
    if (!animated && isInViewport(document.querySelector("#counter"))) {
      animated = true;
      counters.forEach((counter) => {
        const target = +counter.getAttribute("data-target");
        let count = 0;
        const increment = target / speed;
        const addPlusSign = counter.getAttribute("data-plus") === "true";

        function updateCounter() {
          count += increment;
          if (count < target) {
            counter.innerText = Math.ceil(count);
            requestAnimationFrame(updateCounter);
          } else {
            counter.innerText = addPlusSign ? target + "+" : target;
            counter.classList.add("counter-animate");
          }
        }

        updateCounter();
      });
    }
  }

  function isInViewport(element) {
    if (!element) return false;
    const rect = element.getBoundingClientRect();
    return (
      rect.top <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.bottom >= 0
    );
  }

  window.addEventListener("scroll", animateCounters);
  animateCounters();
});

/**
 * Portfolio Carousel (Swiper)
 */
document.addEventListener("DOMContentLoaded", function () {
  const swiper = new Swiper(".portfolioCarousel", {
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    speed: 800,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  const scrollToTopBtn = document.getElementById("scrollToTop");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 300) {
      scrollToTopBtn.style.display = "block";
    } else {
      scrollToTopBtn.style.display = "none";
    }
  });
  scrollToTopBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });
});

/**
 * GLightbox Initialization
 */
const lightbox = GLightbox({
  selector: ".glightbox",
  touchNavigation: true,
  loop: true,
});

/**
 * Portfolio Filtering
 */
document.addEventListener("DOMContentLoaded", () => {
  const filterButtons = document.querySelectorAll(".filter-btn");
  const portfolioItems = document.querySelectorAll(".portfolio-item");

  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      filterButtons.forEach((btn) => btn.classList.remove("active"));
      button.classList.add("active");

      const filter = button.dataset.filter;
      portfolioItems.forEach((item) => {
        if (filter === "*" || item.classList.contains(filter.slice(1))) {
          item.style.display = "block";
        } else {
          item.style.display = "none";
        }
      });
    });
  });
});

/**
 * Product Details Page
 */
document.addEventListener("DOMContentLoaded", function () {
  const thumbnailSwiper = new Swiper(".thumbnailSwiper", {
    slidesPerView: 4,
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      576: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 15,
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
    },
  });

  const lightbox = GLightbox({
    selector: ".glightbox",
  });

  document.querySelectorAll(".thumbnail-item img").forEach((thumb) => {
    thumb.addEventListener("click", function () {
      const mainImg = document.getElementById("mainProductImage");
      const newSrc = this.src.replace("200x200", "800x800");
      mainImg.src = newSrc;

      const parentLink = mainImg.parentElement;
      parentLink.setAttribute("href", newSrc);

      document.querySelectorAll(".thumbnail-item").forEach((item) => {
        item.classList.remove("active");
      });
      this.parentElement.classList.add("active");
    });
  });

  document
    .getElementById("incrementQty")
    .addEventListener("click", function () {
      const qtyInput = document.getElementById("productQty");
      qtyInput.value = parseInt(qtyInput.value) + 1;
    });

  document
    .getElementById("decrementQty")
    .addEventListener("click", function () {
      const qtyInput = document.getElementById("productQty");
      if (parseInt(qtyInput.value) > 1) {
        qtyInput.value = parseInt(qtyInput.value) - 1;
      }
    });

  document.getElementById("productQty").addEventListener("change", function () {
    if (parseInt(this.value) < 1 || isNaN(parseInt(this.value))) {
      this.value = 1;
    }
  });
});

/**
 * Similar Products Swiper
 */
const similarProductsSwiper = new Swiper(".similarProductsSwiper", {
  slidesPerView: 1,
  spaceBetween: 20,
  navigation: {
    nextEl: ".similar-products-next",
    prevEl: ".similar-products-prev",
  },
  breakpoints: {
    576: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 25,
    },
    992: {
      slidesPerView: 4,
      spaceBetween: 30,
    },
    1200: {
      slidesPerView: 5,
      spaceBetween: 30,
    },
  },
});

/**
 * FAQ Toggle
 */
document.addEventListener("DOMContentLoaded", function () {
  const faqItems = document.querySelectorAll(".faq-item");

  faqItems.forEach((item) => {
    const header = item.querySelector("h3");
    const toggle = item.querySelector(".faq-toggle");

    header.addEventListener("click", () => {
      faqItems.forEach((otherItem) => {
        if (otherItem !== item) {
          otherItem.classList.remove("faq-active");
        }
      });
      item.classList.toggle("faq-active");
    });

    toggle.addEventListener("click", (e) => {
      e.stopPropagation();
      item.classList.toggle("faq-active");
    });
  });
});

/**
 * Preloader
 */
window.addEventListener("load", function () {
  document.body.classList.add("loaded");

  setTimeout(function () {
    const preloader = document.getElementById("preloader");
    if (preloader) {
      preloader.remove();
    }
  }, 500);
});
