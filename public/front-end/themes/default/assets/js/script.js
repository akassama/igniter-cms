document.addEventListener("DOMContentLoaded", function () {
  // Scroll to Top Button
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

  // Smooth scrolling for navigation links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();

      const targetId = this.getAttribute("href");
      if (targetId === "#") return;

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        const offset = 70; // Adjust for fixed navbar height
        const targetPosition =
          targetElement.getBoundingClientRect().top +
          window.pageYOffset -
          offset;

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });

        // Update active nav item
        document.querySelectorAll(".nav-link").forEach((link) => {
          link.classList.remove("active");
        });
        this.classList.add("active");
      }
    });
  });

  // Active section highlighting in navigation
  const sections = document.querySelectorAll("section");
  const navItems = document.querySelectorAll(".nav-link");

  window.addEventListener("scroll", function () {
    let current = "";

    sections.forEach((section) => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;

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

  // Pricing card highlight on hover
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

  // Testimonial carousel (if using Bootstrap carousel)
  const testimonialCarousel = document.getElementById("testimonialCarousel");
  if (testimonialCarousel) {
    new bootstrap.Carousel(testimonialCarousel, {
      interval: 5000,
      pause: "hover",
    });
  }
});

// Animated counters
document.addEventListener("DOMContentLoaded", function () {
  // Animated counters
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
        const addPlusSign = counter.getAttribute("data-plus") === "true"; // Check if "+" should be added

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

  // Initialize counters when section is in view
  window.addEventListener("scroll", animateCounters);

  // Initialize counters on page load if already in view
  animateCounters();
});

// Initialize Swiper.js for Portfolio Carousel
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

  // Scroll to Top Button
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

// Initialize GLightbox
const lightbox = GLightbox({
  selector: ".glightbox",
  touchNavigation: true,
  loop: true,
});

// Portfolio Filtering
document.addEventListener("DOMContentLoaded", () => {
  const filterButtons = document.querySelectorAll(".filter-btn");
  const portfolioItems = document.querySelectorAll(".portfolio-item");

  filterButtons.forEach((button) => {
    button.addEventListener("click", () => {
      // Remove active class from all buttons
      filterButtons.forEach((btn) => btn.classList.remove("active"));
      // Add active class to clicked button
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

// Product Details Page Functionality
document.addEventListener("DOMContentLoaded", function () {
  // Initialize Swiper for thumbnails
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

  // Initialize GLightbox for image zoom
  const lightbox = GLightbox({
    selector: ".glightbox",
  });

  // Thumbnail click handler
  document.querySelectorAll(".thumbnail-item img").forEach((thumb) => {
    thumb.addEventListener("click", function () {
      const mainImg = document.getElementById("mainProductImage");
      const newSrc = this.src.replace("200x200", "800x800");
      mainImg.src = newSrc;

      // Update lightbox
      const parentLink = mainImg.parentElement;
      parentLink.setAttribute("href", newSrc);

      // Highlight active thumbnail
      document.querySelectorAll(".thumbnail-item").forEach((item) => {
        item.classList.remove("active");
      });
      this.parentElement.classList.add("active");
    });
  });

  // Quantity controls
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

  // Ensure quantity is at least 1
  document.getElementById("productQty").addEventListener("change", function () {
    if (parseInt(this.value) < 1 || isNaN(parseInt(this.value))) {
      this.value = 1;
    }
  });
});

// Initialize Similar Products Swiper
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

document.addEventListener("DOMContentLoaded", function () {
  // FAQ Toggle functionality
  const faqItems = document.querySelectorAll(".faq-item");

  faqItems.forEach((item) => {
    const header = item.querySelector("h3");
    const toggle = item.querySelector(".faq-toggle");

    header.addEventListener("click", () => {
      // Close all other items
      faqItems.forEach((otherItem) => {
        if (otherItem !== item) {
          otherItem.classList.remove("faq-active");
        }
      });

      // Toggle current item
      item.classList.toggle("faq-active");
    });

    // Also make the toggle icon clickable
    toggle.addEventListener("click", (e) => {
      e.stopPropagation();
      item.classList.toggle("faq-active");
    });
  });
});

//preloader
window.addEventListener("load", function () {
  document.body.classList.add("loaded");

  // Remove preloader from DOM after fade out completes
  setTimeout(function () {
    const preloader = document.getElementById("preloader");
    if (preloader) {
      preloader.remove();
    }
  }, 500); // Match this with the transition time
});
