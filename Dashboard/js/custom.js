const commentInteractionButton = document.querySelector(".comment-button-box");
const commentForm = document.querySelector(".form-comment");
const commentInput = document.querySelector(".comment-input");
const userName = document.querySelector(".userName");
const commentArea = document.querySelector(".comment-area");
const commentBtn = document.querySelector(".comment-submit");
const sideBar = document.querySelector("nav.sidebar");
const sidebarClose = document.querySelector(".sidebar_close_icon");
const year = new Date().getFullYear();
const day = new Date().getDate();
const month = new Date().getMonth() + 1;
const FinalDate = `${year}-${month <= 10 ? "0" + month : month}-${day <= 10 ? "0" + day : day} ${new Date().toLocaleTimeString()}`;
let repliedUsername;
let repliedToMessage;


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
    const userID = document.querySelector('.userID').value;
    const comment = commentInput.value;
    const videoID = document.querySelector('.videoID').value;

    const username = userName.value;
    const firstLetter = username.charAt(0);

    event.preventDefault();
    if (commentInput.value !== "") {

      $.ajax({
        url:'http://localhost/Loom/api/comment.php',
        type:'POST',
        data: {
          userId: userID,
          comment: comment,
          videoId: videoID,
        },
        success: (response) => {
          if(response == 'Success'){
            commentArea.insertAdjacentHTML(
              "afterend",
              `<div class="comment-x" >
                <span class="userprofile">${firstLetter}</span>
                <span class="comment-details">
                    <h4 class="comment-username"><strong>${username}</strong></h4>
                    <div class="comment-text">
                        ${comment}
                    </div>
                    <span class="date">${FinalDate}</span>
                </span>
            </div>`
            );
            commentInteractionButton.classList.remove("disable");
            commentForm.classList.remove("active");
            commentInput.value = "";
          }
        }
      })
    }
  });
}


function prevent(e){
  e = e || window.event;
  e.preventDefault();
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
});

tl.to(".loader", {
  scaleY: 0,
  transformOrigin: "top",
  ease: Expo.easeInOut,
});

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
