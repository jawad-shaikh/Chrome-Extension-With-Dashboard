const downloadlink = document.querySelector(".downloadlink");
const copylink = document.querySelector(".copylink");
const publishComment = document.querySelector("#publishComment");
const videoLink = document.querySelector(".Videosrc");
const videoTitle = document.querySelector('.video-title');

//player js

const player = new Plyr("video", {
  captions: {
    active: true,
  },
});

// Expose player so it can be used from the console

window.player = player;

$(".sidebar_icon").on("click", function () {
  $(".sidebar").toggleClass("active_sidebar");
});

copylink.addEventListener("click", () => {
  let path = videoLink.getAttribute("src");
  path = path.substring(13, path.length);

  const currentUrl = "https://app.recod.io/Dashboard/single.php?vid=";
  const finalUrl = currentUrl + path;
  const copyMess = document.querySelector(".copy-mess");

  copylink.setAttribute("src", finalUrl);
  navigator.clipboard.writeText(copylink.getAttribute("src"));
  copyMess.classList.add("active");

  setTimeout(() => {
    copyMess.classList.remove("active");
  }, 2000);

});




// publish Comment

publishComment.addEventListener("click", () => {

  const commentInput = document.getElementById("commentInput").value;
  const userIdInCommentForm = $("#userIdInCommentForm").val();
  console.log(commentInput);
  console.log(userIdInCommentForm);

});

// Download Link

downloadlink.setAttribute("download", "video");
downloadlink.setAttribute("href", videoLink.getAttribute("src"));



videoTitle.addEventListener("input", () => {
  if(videoTitle.innerText !== ''){
    //ajax
  }
});