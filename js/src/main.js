import './royalslider/jquery.royalslider.min.js';
import Utilities from './Utilities.js';

const main = (function() {
  const BREAKPOINT_XS = 300,
        BREAKPOINT_SM = 600,
        BREAKPOINT_MD = 800,
        BREAKPOINT_LG = 1000,
        BREAKPOINT_XL = 1500,
        CLASS_VH_SM   = '--vh-sm'; // viewport height

  let $window,
      windowHeight,
      windowWidth,
      siteHeader,
      siteHeaderHeight,
      siteNavigation,
      navHeightSet = false,
      $rsContainer,
      $royalSlider,
      $rsMeta,
      $rsControls,
      $rsControlPrev,
      $rsControlNext,
      slider,
      $images;

  function init() {
    cacheDom();
    setWindowDimensions();
    initObserverNavigation();
    handleNavigationDimensions();
    bindEvents();
    render();
  }

  function cacheDom() {
    $window          = jQuery(window);
    siteHeader       = document.getElementById('masthead');
    siteHeaderHeight = siteHeader.clientHeight + siteHeader.offsetTop;
    siteNavigation   = document.getElementById('site-navigation');
    $rsContainer     = jQuery('.royalSlider-container');
    $royalSlider     = $rsContainer.find('.royalSlider');
    $rsMeta          = $rsContainer.find('.rs-meta');
    $rsControls      = $rsContainer.find('.rs-controls');
    $rsControlPrev   = $rsContainer.find('.rs-controls__prev');
    $rsControlNext   = $rsContainer.find('.rs-controls__next');
    $images          = jQuery('img[loading="lazy"]').filter(':visible');
  }

  function bindEvents() {
    $window.on('resize.wells', handleWindowResize);
    $images.one('load.wells', handleImagesLoad);
    $images.each(handleImagesLoadCache);
  }

  function render() {
    if (windowWidth > BREAKPOINT_MD) {
      initRoyalSlider();
    }
  }

  const handleWindowResize = Utilities.debounce(_handleWindowResize, 200);

  function _handleWindowResize(e) {
    setWindowDimensions();

    // RoyalSlider
    if (windowWidth > BREAKPOINT_MD && ! $royalSlider.length) {
      initRoyalSlider();
      showRoyalSlider();
    } else if (windowWidth > BREAKPOINT_MD) {
      showRoyalSlider();
    } else {
      hideRoyalSlider();
    }

    // Navigation
    handleNavigationDimensions();
  }

  function setWindowDimensions() {
    windowHeight = $window.height();
    windowWidth = $window.width();
    return {
      height: windowHeight,
      width: windowWidth
    };
  }

  function handleNavigationDimensions() {
    if (! navHeightSet && windowHeight <= siteHeaderHeight) {
      siteNavigation.style.height = String(siteNavigation.clientHeight / 2) + 'px';
      siteNavigation.style.overflowY = 'auto';
      navHeightSet = true;
    } else if (navHeightSet && windowHeight >= siteHeaderHeight) {
      siteNavigation.style.height = 'auto';
      navHeightSet = false;
    }
  }

  function handleImagesLoad(e) {
    if (this.complete) {
      this.style.opacity = '1';
    }
  }

  function handleImagesLoadCache(index, el) {
    if (window.getComputedStyle(this).opacity === '0' && this.complete) {
      const $this = jQuery(this);
      $this.triggerHandler('load.wells');
    }
  }

  function initRoyalSlider() {
    if (! $royalSlider.length) { return; }

    $royalSlider.royalSlider({
      imageScaleMode: 'fit',
      imageScalePadding: 0,
      controlNavigation: 'bullets',
      arrowsNavAutoHide: false,
      slidesSpacing: 10,
      loop: true,
      numImagesToPreload: 1,
      usePreloader: true,
      transitionType: 'fade',
      controlsInside: false,
      navigateByClick: false,
      sliderDrag: false,
      sliderTouch: false,
      keyboardNavEnabled: true,
      globalCaption: true
    });

    slider = $royalSlider.data('royalSlider');

    // Move .rsNav to .rs-meta
    $rsMeta.prepend($royalSlider.find('.rsNav'));
    $rsMeta.prepend($royalSlider.find('.rsGCaption'));

    bindEventsRs(slider);
  }

  function bindEventsRs(slider) {
    $rsControlPrev.on('click', handleRsPrev);
    $rsControlNext.on('click', handleRsNext);
  }

  function handleRsPrev(e) {
    if (!slider) { return; }
    slider.prev();
  }

  function handleRsNext(e) {
    if (!slider) { return; }
    slider.next();
  }

  function initObserverNavigation() {
    let options = {
      root: null,
      rootMargin: '0px 0px -200px 0px',
      threshold: 1.0
    };

    let observer = new IntersectionObserver(handleIntersect, options);

    function handleIntersect(entries, observer) {
      entries.forEach(entry => {
        handleIntersectRs(entry);
      });
    }
    observer.observe(siteNavigation);
  }

  function handleIntersectRs(entry) {
    if (! $royalSlider.length) { return; }

    if (entry.isIntersecting) {
      $rsMeta.removeClass('rs-meta' + CLASS_VH_SM);
    } else {
      $rsMeta.addClass('rs-meta' + CLASS_VH_SM);
    }
  }

  function showRoyalSlider() {
    $rsContainer.css('display', 'block');
  }

  function hideRoyalSlider() {
    $rsContainer.css('display', 'none');
  }

  return {
    init
  };
})();

export default main;
