/**
 * Hero Swiper
 */
const heroSwiper = new Swiper(".hero-swiper", {
  loop: true,
  speed: 1000,
  parallax: true,
  autoplay: {
    delay: 5000,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

/**
 * Testimonial Swiper
 */
const testimonialSwiper = new Swiper(".testimonial-swiper", {
  loop: true,
  slidesPerView: 1,
  spaceBetween: 30,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

/**
 * GLightbox
 */
const lightbox = GLightbox({
  touchNavigation: true,
  loop: true,
  autoplayVideos: true,
});

/**
 * Scroll to Top Button
 */
const scrollTop = document.querySelector(".scroll-top");
window.addEventListener("scroll", () => {
  if (window.pageYOffset > 100) {
    scrollTop.classList.add("active");
  } else {
    scrollTop.classList.remove("active");
  }
});

scrollTop.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

/**
 * Preloader
 */
window.addEventListener("load", () => {
  const preloader = document.getElementById("preloader");
  preloader.style.opacity = "0";
  setTimeout(() => {
    preloader.style.display = "none";
  }, 500);
});

/**
 * Navbar Scroll Effect
 */
window.addEventListener("scroll", () => {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("navbar-scrolled");
  } else {
    navbar.classList.remove("navbar-scrolled");
  }
});

/**
 * Animation on Scroll
 */
function animateOnScroll() {
  const elements = document.querySelectorAll(".animate__animated");

  elements.forEach((element) => {
    const position = element.getBoundingClientRect();

    if (
      position.top < window.innerHeight - 100 &&
      !element.classList.contains("animate__fadeInUp")
    ) {
      const animationType = element.getAttribute("data-animation");
      element.classList.add("animate__fadeInUp");
    }
  });
}

window.addEventListener("scroll", animateOnScroll);
animateOnScroll();
