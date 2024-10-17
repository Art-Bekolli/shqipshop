export default {
  init() {
    // JavaScript to be fired on the home page
    const swiper = new Swiper('.swiper', {
      // Optional parameters
      direction: 'horizontal'
      , slidesPerView: "auto"
      , centeredSlides: true
      , centeredSlidesBounds: false
      , initialSlide: 1,


      // Navigation arrows
      navigation: {
          nextEl: '.swiper-button-next'
          , prevEl: '.swiper-button-prev'
      , },


  });

  const swipertwo = new Swiper('.swipertwo', {
    // Optional parameters
    direction: 'horizontal', 
    slidesPerView: "auto",
    loop: true,

    breakpoints: {
      // when window width is >= 320px
      720: {
        slidesPerView: 4,
        spaceBetween: 20,
      },
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-nextt'
        , prevEl: '.swiper-button-prevv'
    , },


});

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
