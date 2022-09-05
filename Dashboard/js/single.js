const downloadlink = document.querySelector('.downloadlink');
const copylink = document.querySelector('.copylink');


const videoLink = document.querySelector('.Videosrc');

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

copylink.addEventListener('click', () => {
    let path = videoLink.getAttribute('src');
    path = path.substring(2, path.length);

    const currentUrl = 'http://localhost/github%20loom/Loom-main';
    const finalUrl = currentUrl + path;
    copylink.setAttribute('src', finalUrl);
    navigator.clipboard.writeText(copylink.getAttribute('src'));

})
// Download Link 
downloadlink.setAttribute('download', "video");
downloadlink.setAttribute('href', videoLink.getAttribute('src'));


