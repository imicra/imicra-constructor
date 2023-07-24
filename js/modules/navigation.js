const media = window.matchMedia('(max-width: 992px)');

// button for toggling menu
const toggle = () => {
  let toggle = document.querySelector('.menu-toggle');

  toggle.addEventListener('click', () => {
    document.body.classList.toggle('opened');
  });
};

// toggle sub menu
const subMenu = () => {
  let parentLis = document.querySelectorAll('.menu-item-has-children');

  if (!parentLis.length) {
    return;
  }

  parentLis.forEach(function(parentLi) {
    let trigger = parentLi.querySelector('a > .chevron');
    let subMenu = parentLi.querySelector('.sub-menu');

    trigger.addEventListener('click', function(e) {
      e.preventDefault();

      if (media.matches) {
        if (subMenu.style.maxHeight) {
          subMenu.style.maxHeight = null;
          this.parentNode.classList.remove('expanded');
        } else {
          subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
          this.parentNode.classList.add('expanded');
        }
      }
    });
  });
};

export {toggle, subMenu};
