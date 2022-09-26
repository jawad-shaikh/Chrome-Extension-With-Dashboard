

// const player = new Plyr("video", {
//   captions: {
//     active: true,
//   },
// });

const videos = document.querySelectorAll('video');

if(videos == null){
  const player = new Plyr(video, {
    captions: {
      active: true,
    },
  });
  window.player = player;
}

else{
videos.forEach((video) => {  
 const player = new Plyr(video, {
    captions: {
      active: true,
    },
  });
  window.player = player;
})
}



const videoDownload = document.querySelectorAll('.videoDownload');

videoDownload.forEach((Download) => {
  const link = Download.previousElementSibling.getAttribute('url');
  Download.setAttribute('href', link);
})


$(".sidebar_icon").on("click", function () {
  $(".sidebar").toggleClass("active_sidebar");
});

// Expose player so it can be used from the console

// window.player = player2;
