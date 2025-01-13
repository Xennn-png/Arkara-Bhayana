document.addEventListener("DOMContentLoaded", function () {
  const gameIcons = document.querySelectorAll(".game-icon");

  gameIcons.forEach((icon) => {
    icon.addEventListener("mouseenter", function () {
      const backgroundUrl = this.getAttribute("data-bg");
      document.body.style.backgroundImage = `url(${backgroundUrl})`;
    });

    icon.addEventListener("mouseleave", function () {
      document.body.style.backgroundImage =
        'url("../public/images/background/background1.png")';
    });
  });
});
