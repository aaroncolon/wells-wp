'use strict';

(function() {

  const siteHeight = (function() {

    let siteHeader,
        siteHeaderHeight,
        siteMain;

    function init() {
      cacheDom();
      render();
    }

    function cacheDom() {
      siteHeader = document.getElementById('masthead');
      siteMain   = document.getElementById('primary');
    }

    function render() {
      initResizeObserver();
    }

    function initResizeObserver() {
      const resizeObserver = new ResizeObserver(handleResize);
      resizeObserver.observe(siteHeader);
    }

    function handleResize(entries) {
      for (const entry of entries) {
        siteHeaderHeight = Math.ceil(entry.contentRect.height);
      }
      siteMain.style.minHeight = siteHeaderHeight + 'px';
    }

    return {
      init
    };

  })();

  siteHeight.init();

})()
