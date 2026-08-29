// TODO: Implement this SSISS asset.
document.addEventListener("DOMContentLoaded", function () {
  const mobileMenu = document.getElementById("mobileMenu");

  if (mobileMenu) {
    mobileMenu.addEventListener("click", function () {
      alert("Mobile navigation will be added here.");
    });
  }

  // Smooth reveal animation

  const sections = document.querySelectorAll(
    ".vibe-section, .ai-section, .impact-banner",
  );

  const observer = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.style.opacity = "1";

          entry.target.style.transform = "translateY(0)";
        }
      });
    },

    {
      threshold: 0.1,
    },
  );

  sections.forEach(function (section) {
    section.style.opacity = "0";

    section.style.transform = "translateY(30px)";

    section.style.transition = "0.8s ease";

    observer.observe(section);
  });
});
