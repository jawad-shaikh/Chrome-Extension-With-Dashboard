const downloadlink = document.querySelector('.downloadlink');
const copylink = document.querySelector('.copylink');


const videoLink = document.querySelector('.Videosrc');

// Change the second argument to your options:
// https://github.com/sampotts/plyr/#options
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

copylink.addEventListener('click', () => {
    navigator.clipboard.writeText(videoLink.getAttribute('src'));
})

downloadlink.setAttribute('download', "video");
downloadlink.setAttribute('href', videoLink.getAttribute('src'));


