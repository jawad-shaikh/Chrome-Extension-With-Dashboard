function complete() {
  tl.to(".anim", { clearProps: "all" });
}

const tl = gsap.timeline();

tl.from(".loader span", {
  y: 40,
  autoAlpha: 0,
  stagger: 0.1,duration:.1
});

tl.to(".loader span", {
  y: -40,
  autoAlpha: 0,
  stagger: 0.1,
  duration:.1,
  delay:1
});

tl.to(".loader", {
  scaleY: 0,
  transformOrigin: "top",
  ease: Expo.easeInOut,
  duration: 1,
});



tl.from(".anim", {
  autoAlpha: 0,
  y: 20,
  stagger: 0.1,
  onComplete: complete,
});
