const commentInteractionButton = document.querySelector(".comment-button-box");
const commentForm = document.querySelector(".form-comment");
const commentInput = document.querySelector(".comment-input");
const commentArea = document.querySelector(".comment-area");
const commentBtn = document.querySelector(".comment-submit");
const sideBar = document.querySelector("nav.sidebar");
const sidebarClose = document.querySelector(".sidebar_close_icon");
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
        "afterbegin",
        `<div class="comment-x">
                                    <span class="userprofile">${firstLetter}</span>
                                    <span class="comment-details">
                                        <h4 class="comment-username"><strong>${username}</strong></h4>
                                        <span>at ${time}</span>
                                        <div class="comment-text">
                                            ${comment}
                                        </div>
                                        <span class="date">${diffDays} Days Ago</span>
                                        <span class="comment-button-box reply-box" id="area" onclick="getReply(this)">
                                        <ion-icon name="arrow-undo-outline"></ion-icon><button class="comment-button reply-btn">Reply</button>
                                      </span>

                                      <form action="" class="form-comment second" onsubmit="prevent(event)">
                                      <input type="text" class="comment-input reply-input" placeholder="Reply.." />
                                      <button type="submit" class="comment-submit" onclick="postReply(this)">
                                        <ion-icon name="chevron-forward-outline"></ion-icon>
                                      </button>
                                    </form>

                                    </span>
                                </div>`
      );

      commentInteractionButton.classList.remove("disable");
      commentForm.classList.remove("active");
      commentInput.value = "";
    }
  });
}

function getReply(replyBtn){
      const form = replyBtn.parentElement.querySelector('.form-comment.second');
      const replyBox = replyBtn.parentElement.querySelector('.reply-box');
      const replyTo = replyBtn.parentElement.querySelector('.comment-username');
      const replyInputField = replyBtn.parentElement.querySelector('.reply-input');
      const messageTo = replyBtn.parentElement.querySelector('.comment-text');

      console.log(replyBtn.parentElement);

      replyBox.classList.add("disable");
      form.classList.add("active");
      repliedUsername = `@${replyTo.innerText}`;
      repliedToMessage = messageTo.innerText;
}


function closeOpenFields(thisElement){
  const form = thisElement.parentElement.parentElement.querySelector('.form-comment.second');
  const replyBox = thisElement.parentElement.parentElement.querySelector('.reply-box');

  replyBox.classList.remove("disable");
  form.classList.remove("active");

}

function postReply(thisElement){
  const commentSubmit = document.querySelector('.comment-submit');

  commentSubmit.addEventListener('click', e => {
    e.preventDefault();
  })

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
  const replyInput = thisElement.parentElement.querySelector('.reply-input');
  const reply = replyInput.value;



  if (replyInput.value !== "") {
    commentArea.insertAdjacentHTML(
      "beforeend",
      `<div class="comment-x">
                                  <span class="userprofile">${firstLetter}</span>
                                  <span class="comment-details">
                                   <div class="reply-to">
                                    <span>Replied To <strong>${repliedUsername}</strong></span>
                                    <span style="display:block;">${repliedToMessage}</span>
                                   </div>
                                      <h4 class="comment-username"><strong>${username}</strong></h4>
                                      <span>at ${time}</span>
                                      <div class="comment-text">
                                         <strong>${repliedUsername}</strong> ${reply}
                                      </div>
                                      <span class="date">${diffDays} Days Ago</span>
                                      <span class="comment-button-box reply-box" id="area" onclick="getReply(this)">
                                      <ion-icon name="arrow-undo-outline"></ion-icon><button class="comment-button reply-btn">Reply</button>
                                    </span>

                                    <form class="form-comment second" onsubmit="prevent(event)">
                                    <input type="text" class="comment-input reply-input" placeholder="Reply.." />
                                    <button type="submit" class="comment-submit" onclick="postReply(this)">
                                      <ion-icon name="chevron-forward-outline"></ion-icon>
                                    </button>
                                  </form>

                                  </span>
                              </div>`);

  }
  
  closeOpenFields(thisElement);
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
