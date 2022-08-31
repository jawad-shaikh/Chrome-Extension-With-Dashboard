const DotsMenu = document.querySelector(".dots-menu");
const MobileViewLinks = document.querySelector(".mobile-view-links");
const sideBar = document.querySelector("nav.sidebar");
const sidebarClose = document.querySelector(".sidebar_close_icon");

sidebarClose.addEventListener("click", () => {
  sideBar.classList.remove("active_sidebar");
});

//active sidebar
$(".sidebar_icon").on("click", function () {
  $(".sidebar").toggleClass("active_sidebar");
});

//active menu
$(".troggle_icon").on("click", function () {
  $(".setting_navbar_bar").toggleClass("active_menu");
});

DotsMenu.addEventListener("click", (e) => {
  e.preventDefault();
  MobileViewLinks.classList.toggle("active");
});

document.body.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("dots-menu") ||
    e.target.getAttribute("name") == "ellipsis-horizontal-outline"
  ) {
    e.preventDefault();
  } else {
    if (MobileViewLinks.classList.contains("active")) {
      document
        .querySelector(".mobile-view-links.active")
        .classList.remove("active");
    }
  }
});

const player = new Plyr("video", {
  captions: {
    active: true,
  },
});

const player2 = new Plyr("video.video2", {
  captions: {
    active: true,
  },
});

// Expose player so it can be used from the console
window.player = player;
window.player = player2;

function complete() {
  tl.to(".anim", { clearProps: "all" });
}

const tl = gsap.timeline();

tl.from(".loader span", {
  y: 40,
  autoAlpha: 0,
  stagger: 0.1,
});

tl.to(".loader span", {
  y: -40,
  autoAlpha: 0,
  stagger: 0.1,
  delay: 1,
});

tl.to(".loader", {
  scaleY: 0,
  transformOrigin: "top",
  ease: Expo.easeInOut,
  duration: 1,
});

tl.to(
  ".loader-back",
  {
    scaleY: 0,
    transformOrigin: "bottom",
    ease: Expo.easeInOut,
    duration: 1,
  },
  "-=.1"
);

tl.from(".anim", {
  autoAlpha: 0,
  y: 20,
  stagger: 0.1,
  onComplete: complete,
});
