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
      $subMenu.css('height', '0px');
      $subMenu
        .removeClass(CLASS_OPEN)
        .addClass(CLASS_CLOSED);
    } else {
      $subMenu.css('height', String($subMenu.get(0).scrollHeight + 'px'));
      $subMenu
        .removeClass(CLASS_CLOSED)
        .addClass(CLASS_OPEN);
    }
  }

  function initHeights() {
    $folders.each(function(index, el) {
      const $subMenu = jQuery(this).find('.sub-menu');

      if (! $subMenu.children().hasClass('current-menu-item')) {
        $subMenu
          .css('height', '0px')
          .addClass(CLASS_CLOSED);
      } else {
        // CSS `height: auto` for immediate display when .current-menu-item present
        $subMenu
          .css('height', 'auto')
          .addClass(CLASS_OPEN);
        // set inline height for CSS transitions
        $subMenu.css('height', String($subMenu.get(0).scrollHeight + 'px'));
      }
    });
  }

  return {
    init
  };
})()

export default navigationFolders;
