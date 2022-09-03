const commentInteractionButton = document.querySelector(".comment-button-box");
const commentForm = document.querySelector(".form-comment");
const commentInput = document.querySelector(".comment-input");
const commentArea = document.querySelector(".comment-area");
const commentBtn = document.querySelector(".comment-submit");
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

if (commentInteractionButton !== null) {
  commentInteractionButton.addEventListener("click", () => {
    commentInteractionButton.classList.add("disable");
    commentForm.classList.add("active");
  });
}

const interactionLinks = document.querySelectorAll(".interaction-link");

interactionLinks.forEach((link) => {
  link.addEventListener("mouseover", () => {
    link.querySelector(".it-title").classList.add("active");
  });
  link.addEventListener("mouseleave", () => {
    link.querySelector(".it-title").classList.remove("active");
  });
});

if (commentBtn !== null) {
  commentBtn.addEventListener("click", (event) => {
    const year = new Date().getFullYear();
    const day = new Date().getDay();
    const month = new Date().getMonth() + 1;
    const username = "Username";
    const firstLetter = username.charAt(0);
    const oneDay = 24 * 60 * 60 * 1000;
    const firstDate = new Date(year, month, day);
    const secondDate = new Date(year, month, day);
    const time = new Date().toLocaleTimeString();
    const diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));

    event.preventDefault();
    const comment = commentInput.value;
    if (commentInput.value !== "") {
      commentArea.insertAdjacentHTML(
        "beforebegin",
        `<div class="comment-x">
                                    <span class="userprofile">${firstLetter}</span>
                                    <span class="comment-details">
                                        <h4 class="comment-username"><strong>${username}</strong> at ${time}</h4>
                                        <div class="comment-text">
                                            ${comment}
                                        </div>
                                        <span class="date">${diffDays} Days Ago</span>
                                    </span>
                                </div>`
      );

      commentInteractionButton.classList.remove("disable");
      commentForm.classList.remove("active");
      commentInput.value = "";
    }
  });
}



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

$(window).on("scroll", function () {
  var scroll = $(window).scrollTop();
  if (scroll < 400) {
    $("#back-top").fadeOut(500);
  } else {
    $("#back-top").fadeIn(500);
  }
});

// back to top
$("#back-top a").on("click", function () {
  $("body,html").animate(
    {
      scrollTop: 0,
    },
    1000
  );
  return false;
});

//active sidebar
$(".sidebar_icon").on("click", function () {
  $(".sidebar").toggleClass("active_sidebar");
});

//active menu
$(".troggle_icon").on("click", function () {
  $(".setting_navbar_bar").toggleClass("active_menu");
});

//remove sidebar
$(document).click(function (event) {
  if (!$(event.target).closest(".sidebar_icon, .sidebar").length) {
    $("body").find(".sidebar").removeClass("active_sidebar");
  }
});
