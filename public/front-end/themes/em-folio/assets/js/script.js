// Initialize AOS
AOS.init({
  duration: 1000,
  easing: "ease-in-out",
  once: true,
  mirror: false,
});

// Theme Toggle
const themeToggle = document.getElementById("themeToggle");
const html = document.documentElement;

// Load saved theme from localStorage
const savedTheme = localStorage.getItem("theme") || "light";
html.setAttribute("data-theme", savedTheme);
updateThemeIcon(savedTheme);

themeToggle.addEventListener("click", () => {
  const currentTheme = html.getAttribute("data-theme");
  const newTheme = currentTheme === "light" ? "dark" : "light";
  html.setAttribute("data-theme", newTheme);
  localStorage.setItem("theme", newTheme);
  updateThemeIcon(newTheme);
});

function updateThemeIcon(theme) {
  themeToggle.innerHTML =
    theme === "light"
      ? '<i class="ri-moon-line"></i>'
      : '<i class="ri-sun-line"></i>';
}

// Navbar scroll effect
window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.style.background =
      html.getAttribute("data-theme") === "dark"
        ? "rgba(17, 24, 39, 0.95) !important"
        : "rgba(255, 255, 255, 0.95) !important";
    navbar.style.boxShadow =
      html.getAttribute("data-theme") === "dark"
        ? "0 2px 20px rgba(0, 0, 0, 0.3) !important"
        : "0 2px 20px rgba(0, 0, 0, 0.1) !important";
  } else {
    navbar.style.background =
      html.getAttribute("data-theme") === "dark"
        ? "rgba(17, 24, 39, 0.95) !important"
        : "rgba(255, 255, 255, 0.95) !important";
    navbar.style.boxShadow =
      html.getAttribute("data-theme") === "dark"
        ? "0 2px 20px rgba(0, 0, 0, 0.3) !important"
        : "0 2px 20px rgba(0, 0, 0, 0.1) !important";
  }
});

// Active nav link highlighting
const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll(".nav-link");

window.addEventListener("scroll", function () {
  let current = "";
  sections.forEach((section) => {
    const sectionTop = section.offsetTop;
    const sectionHeight = section.clientHeight;
    if (pageYOffset >= sectionTop - 200) {
      current = section.getAttribute("id");
    }
  });

  navLinks.forEach((link) => {
    link.classList.remove("active");
    if (link.getAttribute("href") === `#${current}`) {
      link.classList.add("active");
    }
  });
});

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});

// Animate progress bars when they come into view
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver(function (entries) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      const progressBars = entry.target.querySelectorAll(".progress-bar");
      progressBars.forEach((bar) => {
        const width = bar.style.width;
        bar.style.width = "0%";
        setTimeout(() => {
          bar.style.width = width;
        }, 100);
      });
    }
  });
}, observerOptions);

const skillsSection = document.querySelector("#skills");
if (skillsSection) {
  observer.observe(skillsSection);
}

// Contact form submission
document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault();
  alert("Thank you for your message! I will get back to you soon.");
  this.reset();
});

// Subscribe form submission
document
  .getElementById("subscribeForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    alert("Thank you for subscribing to my newsletter!");
    this.reset();
  });

// Counter animation for stats
function animateCounter(element, start, end, duration) {
  let startTimestamp = null;
  const step = (timestamp) => {
    if (!startTimestamp) startTimestamp = timestamp;
    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
    element.innerHTML = Math.floor(progress * (end - start) + start);
    if (progress < 1) {
      window.requestAnimationFrame(step);
    }
  };
  window.requestAnimationFrame(step);
}

const statsSection = document.querySelector("#stats");
if (statsSection) {
  const statsObserver = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const counters = entry.target.querySelectorAll(".stat-number");
        counters.forEach((counter) => {
          const end = parseInt(counter.getAttribute("data-count"));
          animateCounter(counter, 0, end, 2000);
        });
        statsObserver.unobserve(entry.target);
      }
    });
  }, observerOptions);
  statsObserver.observe(statsSection);
}

// Typing animation for hero section
function typeWriter(element, text, speed = 100) {
  let i = 0;
  element.innerHTML = "";

  function type() {
    if (i < text.length) {
      element.innerHTML += text.charAt(i);
      i++;
      setTimeout(type, speed);
    }
  }
  type();
}

window.addEventListener("load", function () {
  const heroTitle = document.querySelector(".hero h1");
  if (heroTitle) {
    const originalText = heroTitle.textContent;
    typeWriter(heroTitle, originalText, 100);
  }
});

// Parallax effect for hero section
window.addEventListener("scroll", function () {
  const scrolled = window.pageYOffset;
  const hero = document.querySelector(".hero");
  if (hero) {
    hero.style.transform = `translateY(${scrolled * 0.5}px)`;
  }
});

// Hover effects for portfolio items
document.querySelectorAll(".portfolio-item").forEach((item) => {
  item.addEventListener("mouseenter", function () {
    this.style.transform = "scale(1.05)";
  });

  item.addEventListener("mouseleave", function () {
    this.style.transform = "scale(1)";
  });
});

// Mobile menu close on link click
document.querySelectorAll(".nav-link").forEach((link) => {
  link.addEventListener("click", function () {
    const navbarCollapse = document.querySelector(".navbar-collapse");
    if (navbarCollapse.classList.contains("show")) {
      const bsCollapse = new bootstrap.Collapse(navbarCollapse);
      bsCollapse.hide();
    }
  });
});

// Scroll to Top Functionality
const scrollToTopBtn = document.querySelector(".scroll-to-top");

window.addEventListener("scroll", () => {
  if (window.pageYOffset > 300) {
    scrollToTopBtn.classList.add("active");
  } else {
    scrollToTopBtn.classList.remove("active");
  }
});

scrollToTopBtn.addEventListener("click", () => {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

//preloader
// window.addEventListener("load", function () {
//   document.body.classList.add("loaded");

//   // Remove preloader from DOM after fade out completes
//   setTimeout(function () {
//     const preloader = document.getElementById("preloader");
//     if (preloader) {
//       preloader.remove();
//     }
//   }, 500); // Match this with the transition time
// });
