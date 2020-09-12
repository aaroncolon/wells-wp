'use strict';

(function() {

  const navigationFolders = (function() {
    const CLASS_OPEN = 'sub-menu--open';
    const CLASS_CLOSED = 'sub-menu--closed';
    let $folders;

    function init() {
      cacheDom();
      bindEvents();
      render();
    }

    function cacheDom() {
      $folders = jQuery('.folder');
    }

    function bindEvents() {
      $folders.on('click', '> a', null, handleClick);
    }

    function render() {
      initHeights();
    }

    function handleClick(e) {
      e.preventDefault();
      toggleMenu(e);
    }

    function toggleMenu(e) {
      const $subMenu = jQuery(e.target).siblings('.sub-menu');

      if ($subMenu.hasClass('sub-menu--open')) {
        // animate close the menu
        $subMenu.animate(
          {'height': 0},
          100,
          'linear',
          () => {
            $subMenu.removeClass(CLASS_OPEN).addClass(CLASS_CLOSED);
          }
        );
      } else {
        // animate open the menu
        $subMenu.animate(
          {'height': $subMenu.attr('data-height')},
          100,
          'linear',
          () => {
            $subMenu.removeClass(CLASS_CLOSED).addClass(CLASS_OPEN);
          }
        );
      }
    }

    function initHeights() {
      $folders.each(function(index, el) {
        const $subMenu = jQuery(this).find('.sub-menu');
        const height = $subMenu.css('height'); // .css ('height') respects box-sizing

        $subMenu.attr('data-height', height);

        if (! $subMenu.children().hasClass('current-menu-item')) {
          $subMenu.css('height', 0);
          $subMenu.removeClass(CLASS_OPEN).addClass(CLASS_CLOSED);
        } else {
          $subMenu.removeClass(CLASS_CLOSED).addClass(CLASS_OPEN);
        }
      });
    }

    return {
      init: init
    };
  })()

  navigationFolders.init();
})()
