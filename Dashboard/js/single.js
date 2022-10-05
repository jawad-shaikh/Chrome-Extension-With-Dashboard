const downloadlink = document.querySelector(".downloadlink");

const copylink = document.querySelector(".copylink");

const publishComment = document.querySelector("#publishComment");

const videoLink = document.querySelector(".Videosrc");

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

  copylink.setAttribute("src", finalUrl);

  navigator.clipboard.writeText(copylink.getAttribute("src"));
});

// publish Comment

publishComment.addEventListener("click", () => {
  var commentInput = document.getElementById("commentInput").value;

  var userIdInCommentForm = $("#userIdInCommentForm").val();

  console.log(commentInput);

  console.log(userIdInCommentForm);
});

// Download Link

downloadlink.setAttribute("download", "video");

downloadlink.setAttribute("href", videoLink.getAttribute("src"));
