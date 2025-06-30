// Theme toggle functionality
document.addEventListener("DOMContentLoaded", function () {
  const themeToggle = document.getElementById("themeToggle");
  const htmlElement = document.documentElement;
  const sunIcon = themeToggle.querySelector(".bi-sun-fill");
  const moonIcon = themeToggle.querySelector(".bi-moon-fill");

  // Check for saved theme preference or use preferred color scheme
  const savedTheme =
    localStorage.getItem("theme") ||
    (window.matchMedia("(prefers-color-scheme: dark)").matches
      ? "dark"
      : "light");

  // Apply the saved theme
  htmlElement.setAttribute("data-bs-theme", savedTheme);
  updateIcons(savedTheme);

  // Toggle theme on button click
  themeToggle.addEventListener("click", function () {
    const currentTheme = htmlElement.getAttribute("data-bs-theme");
    const newTheme = currentTheme === "dark" ? "light" : "dark";

    htmlElement.setAttribute("data-bs-theme", newTheme);
    localStorage.setItem("theme", newTheme);
    updateIcons(newTheme);
  });

  function updateIcons(theme) {
    if (theme === "dark") {
      sunIcon.classList.add("d-none");
      moonIcon.classList.remove("d-none");
      themeToggle.classList.remove("btn-outline-secondary");
      themeToggle.classList.add("btn-outline-light");
    } else {
      sunIcon.classList.remove("d-none");
      moonIcon.classList.add("d-none");
      themeToggle.classList.remove("btn-outline-light");
      themeToggle.classList.add("btn-outline-secondary");
    }
  }

  // Initialize tooltips
  const tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Preloader
  const preloader = document.getElementById("preloader");
  window.addEventListener("load", function () {
    preloader.style.display = "none";
  });

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
});
