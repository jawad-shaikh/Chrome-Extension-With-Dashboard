const localUrl = "https://localhost/Loom/";
const serverUrl = "https://app.recod.io/";

$(document).ready(function () {
  setTimeout(() => {
    saveAutomatically();
  }, 1500);

  $("#share").css("cursor", "not-allowed");

  const closeBtn = document.querySelector(".closeBtn");
  const updateTitleBtn = document.getElementById("updateTitleBtn");

  if (closeBtn !== null) {
    closeBtn.addEventListener("click", () => {
      closeBtn.parentElement.parentElement.classList.add("hide");
      showBosyMessage();
    });
  }

  updateTitleBtn.addEventListener("click", () => {
    updateTitle();
  });

  function showBosyMessage() {
    const waitMess = document.querySelector(".wait-msg");
    waitMess.classList.add("active");

    setTimeout(() => {
      waitMess.classList.remove("active");
    }, 2000);
  }

  var videoUrlWhichJustGotSaved;
  var blobs = recordedBlobs;
  var player;
  var trimslider = document.getElementById("trimslider");
  var removeslider = document.getElementById("removeslider");
  var setup = true;
  let hook = true;

  function getLink(url) {
    const copyLink = document.querySelector(".copyTo");
    const copyMess = document.querySelector(".copy-mess");

    if (copyLink.hasAttribute("disabled")) {
      copyLink.removeAttribute("disabled");
      copyLink.removeAttribute("aria-disabled");
    }

    copyLink.style.cursor = "pointer";

    copyLink.addEventListener("click", (e) => {
      const finalUrl = `${serverUrl}Dashboard/single.php?vid=${url}`;
      e.preventDefault();
      copyMess.classList.add("active");
      navigator.clipboard.writeText(finalUrl);
      setTimeout(() => {
        copyMess.classList.remove("active");
      }, 2000);
    });
  }

  function goodbye(e) {
    if (!e) e = window.event;
    //e.cancelBubble is supported by IE - this will kill the bubbling process.
    e.cancelBubble = true;
    e.returnValue = "You sure you want to leave? Video is not yet Uploaded!"; //This is displayed on the dialog

    //e.stopPropagation works in Firefox.
    if (e.stopPropagation) {
      e.stopPropagation();
      e.preventDefault();
    }
  }

  // Show recorded video
  if (url == "" || url == null) {
    // Show recorded video
    var superBuffer = new Blob(recordedBlobs, {
      type: "video/webm",
    });

    // Create the src url from the blob. #t=duration is a Chrome bug workaround, as the webm generated through Media Recorder has a N/A duration in its metadata, so you can't seek the video in the player. Using Media Fragments (https://www.w3.org/TR/media-frags/#URIfragment-user-agent) and setting the duration manually in the src url fixes the issue.
    var url = window.URL.createObjectURL(superBuffer);
  }

  $("#video").attr("src", url + "#t=" + blobs.length);
  $("#g-savetodrive").attr("src", url);
  $("#format-select").niceSelect();

  // Convert seconds to timestamp
  function timestamp(value) {
    var sec_num = value;
    var hours = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - hours * 3600) / 60);
    var seconds = sec_num - hours * 3600 - minutes * 60;

    if (hours < 10) {
      hours = "0" + hours;
    }
    if (minutes < 10) {
      minutes = "0" + minutes;
    }
    if (seconds < 10) {
      seconds = "0" + seconds;
    }
    return hours + ":" + minutes + ":" + seconds;
  }

  // Initialize range sliders
  function initRanges() {
    noUiSlider.create(trimslider, {
      start: [blobs.length],
      connect: "upper",
      range: {
        min: 0,
        max: blobs.length,
      },
    });
    $("#trim-end input").val(timestamp(blobs.length));

    noUiSlider.create(removeslider, {
      start: [0, blobs.length],
      connect: true,
      range: {
        min: 0,
        max: blobs.length,
      },
    });
    $("#remove-end input").val(timestamp(blobs.length));
  }

  // Update range values
  function updateRanges(blobs) {
    trimslider.noUiSlider.updateOptions({
      start: [blobs.length],
      range: {
        min: 0,
        max: blobs.length,
      },
    });
    $("#trim-start input").val(timestamp(0));
    $("#trim-end input").val(timestamp(blobs.length));

    removeslider.noUiSlider.updateOptions({
      start: [0, blobs.length],
      range: {
        min: 0,
        max: blobs.length,
      },
    });
    $("#remove-start input").val(timestamp(0));
    $("#remove-end input").val(timestamp(blobs.length));
    window.setTimeout(function () {
      player.currentTime = 0;
    }, 500);
    player.restart();
  }

  // Reset video
  function reset() {
    blobs = recordedBlobs;
    var superBuffer = new Blob(blobs, {
      type: "video/webm",
    });
    var url = window.URL.createObjectURL(superBuffer);
    $("#video").attr("src", url + "#t=" + blobs.length);
    updateRanges(blobs);
  }

  // Trim video between two values
  function trim(a, b) {
    blobs = blobs.slice(a, b);
    var superBuffer = new Blob(blobs, {
      type: "video/webm",
    });
    var url = window.URL.createObjectURL(superBuffer);
    $("#video").attr("src", url + "#t=" + blobs.length);
    updateRanges(blobs);
  }

  // Remove part of the video
  function remove(a, b) {
    var start = blobs.slice(0, a);
    var end = blobs.slice(b, blobs.length);
    blobs = start.concat(end);
    var superBuffer = new Blob(blobs, {
      type: "video/webm",
    });
    var url = window.URL.createObjectURL(superBuffer);
    $("#video").attr("src", url + "#t=" + blobs.length);
    updateRanges(blobs);
  }

  // Download video in different formats
  function download() {
    downloaded = true;
    $("#download-label").html(chrome.i18n.getMessage("downloading"));
    if ($("#format-select").val() == "mp4") {
      ysFixWebmDuration(blobs, blobs.length, function (fixedBlob) {
        var superBuffer = new Blob(fixedBlob, {
          type: "video/mp4",
        });
        var url = window.URL.createObjectURL(superBuffer);
        chrome.downloads.download({
          url: url,
        });
        $("#download-label").html(chrome.i18n.getMessage("download"));
      });
    } else if ($("#format-select").val() == "webm") {
      ysFixWebmDuration(blobs, blobs.length, function (fixedBlob) {
        var superBuffer = new Blob(fixedBlob, {
          type: "video/webm",
        });
        var url = window.URL.createObjectURL(superBuffer);
        chrome.downloads.download({
          url: url,
        });
        $("#download-label").html(chrome.i18n.getMessage("download"));
      });
    } else if ($("#format-select").val() == "gif") {
      var superBuffer = new Blob(blobs, {
        type: "video/webm",
      });
      convertStreams(superBuffer, "gif");
    }
  }

  function removeLoading() {
    const loading = document.querySelector(".loading");
    loading.classList.add("hide");
  }

  // save Automatically
  function saveAutomatically() {
    downloaded = true;
    window.onbeforeunload = goodbye;
    var title = $("#titleText").val();
    var metadata = {
      name: "video.mp4",
      mimeType: "video/mp4",
    };
    var superBuffer = new Blob(blobs, {
      type: "video/mp4",
    });
    var form = new FormData();
    form.append(
      "metadata",
      new Blob([JSON.stringify(metadata)], { type: "application/json" })
    );
    form.append("file", superBuffer);
    form.append("title", title);

    chrome.storage.sync.get(["userId"], function (result) {
      form.append("userId", result.userId);

      $.ajax({
        type: "POST",
        url: `${serverUrl}/api/saveRecording.php`,
        data: form,
        processData: false,
        contentType: false,
      }).done(function (data) {
        if (data !== "") {
          navigator.clipboard.writeText(data);
          let result = data.indexOf("=");
          videoUrlWhichJustGotSaved = data.substr(result + 1);
          console.log(videoUrlWhichJustGotSaved);
          getLink(videoUrlWhichJustGotSaved);
          removeLoading();
          finishUploadMessage();
          saveBtnListener();
        }
      });
    });
  }

  function saveBtnListener() {
    $("#share").on("click", function () {
      saveDrive();
    });
    $("#share").css("cursor", "pointer");
  }

  function finishUploadMessage() {
    const finishMsg = document.querySelector(".finish-msg");
    finishMsg.classList.add("active");

    setTimeout(() => {
      finishMsg.classList.remove("active");
    }, 2000);
  }

  // update title
  function updateTitle() {
    var title = $("#titleText").val();
    var videoToReplace = videoUrlWhichJustGotSaved;

    var form = new FormData();

    form.append("title", title);
    form.append("videoToReplace", videoToReplace);

    chrome.storage.sync.get(["userId"], function (result) {
      form.append("userId", result.userId);

      $.ajax({
        type: "POST",
        url: `${serverUrl}api/updateTitle.php`,
        data: form,
        processData: false,
        contentType: false,
      }).done(function (data) {
        if (data !== "") {
          alert("updated title");
        }
      });
    });
  }

  // Save on Drive
  function saveDrive() {
    downloaded = true;

    $("#share span").html(chrome.i18n.getMessage("saving"));
    $("#share").css("pointer-events", "none");
    var title = $("#titleText").val();
    var videoToReplace = videoUrlWhichJustGotSaved;
    var metadata = {
      name: "video.mp4",
      mimeType: "video/mp4",
    };
    var superBuffer = new Blob(blobs, {
      type: "video/mp4",
    });
    var form = new FormData();
    form.append(
      "metadata",
      new Blob([JSON.stringify(metadata)], { type: "application/json" })
    );
    form.append("file", superBuffer);
    form.append("title", title);
    form.append("videoToReplace", videoToReplace);

    chrome.storage.sync.get(["userId"], function (result) {
      form.append("userId", result.userId);

      $.ajax({
        type: "POST",
        url: `${serverUrl}api/updateRecording.php`,
        data: form,
        processData: false,
        contentType: false,
      }).done(function (data) {
        if (data !== "") {
          const saveBtn = document.querySelector("#share span");
          saveBtn.innerText = "Saved!";
          navigator.clipboard.writeText(data);
        }
      });
    });
  }

  // Check when video has been loaded
  $("#video").on("loadedmetadata", function () {
    // Initialize custom video player
    player = new Plyr("#video", {
      controls: [
        "play-large",
        "play",
        "progress",
        "current-time",
        "duration",
        "mute",
        "volume",
        "fullscreen",
      ],
      ratio: "16:9",
    });

    // Check when player is ready
    player.on("canplay", function () {
      // First time setup
      if (setup) {
        setup = false;
        initRanges();
        player.currentTime = 0;
      }

      // Check when trim slider values change
      trimslider.noUiSlider.on("slide", function (values, handle) {
        $("#trim-start input").val(timestamp(0));
        $("#trim-end input").val(timestamp(values[0]));
        player.currentTime = parseFloat(values[handle]);
      });

      // Check when remove slider values change
      removeslider.noUiSlider.on("slide", function (values, handle) {
        $("#remove-start input").val(timestamp(values[0]));
        $("#remove-end input").val(timestamp(values[1]));
        player.currentTime = parseFloat(values[handle]);
      });
    });
  });

  // Applying a trim
  $("#apply-trim").on("click", function () {
    trim(0, parseInt(trimslider.noUiSlider.get()[0]));
  });

  // Removing part of the video
  $("#apply-remove").on("click", function () {
    remove(
      parseInt(removeslider.noUiSlider.get()[0]),
      parseInt(removeslider.noUiSlider.get()[1])
    );
  });

  // Download video
  $("#download").on("click", function () {
    download();
  });

  // Save on Drive

  // Revert changes made to the video
  $("#reset").on("click", function () {
    reset();
  });

  // For mobile version
  $("#show-hide").on("click", function () {
    $("#settings").toggleClass("hidepanel");
    $("#export").toggleClass("hidepanel");
  });

  // Localization (strings in different languages)
  $("#made-with").html(chrome.i18n.getMessage("made_with"));
  $("#by-alyssa").html(chrome.i18n.getMessage("by_alyssa"));
  $("#rate-label").html(chrome.i18n.getMessage("rate_extension"));
  $("#show-hide").html(chrome.i18n.getMessage("show_hide"));
  $("#edit-label").html(chrome.i18n.getMessage("edit_recording"));
  $("h2").html(chrome.i18n.getMessage("edit_recording_desc"));
  $("#format-select-label").html(chrome.i18n.getMessage("format"));
  $("#webm-default").html(chrome.i18n.getMessage("webm"));
  $("#trim-label").html(chrome.i18n.getMessage("trim_video"));
  $(".start-label").html(chrome.i18n.getMessage("start"));
  $(".end-label").html(chrome.i18n.getMessage("end"));
  $("#apply-trim").html(chrome.i18n.getMessage("apply"));
  $("#remove-label").html(chrome.i18n.getMessage("remove_part"));
  $("#format-select-label").html(chrome.i18n.getMessage("format"));
  $("#apply-remove").html(chrome.i18n.getMessage("apply"));
  $("#reset").html(chrome.i18n.getMessage("reset"));
  $("#download-label").html(chrome.i18n.getMessage("download"));
  $("#share span").html(chrome.i18n.getMessage("save_drive"));
  $("#apply-trim").html(chrome.i18n.getMessage("apply"));
});

const titleInput = document.querySelector(".title-input");
titleInput.value = new Date();
titleInput.select();
