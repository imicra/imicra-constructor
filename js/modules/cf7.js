const cf7 = () => {
  let forms = document.querySelectorAll('.wpcf7');

  if (!forms.length) {
    return;
  }

  let content_wpcf7 = document.querySelector( '.entry-content .wpcf7' );
  let modal_wpcf7 = document.querySelector( '.modal .wpcf7' );
    
  let disableSubmit = false;

  forms.forEach((form) => {
    let btn = form.querySelector('input.wpcf7-submit[type="submit"]');

    btn.addEventListener('click', () => {

      btn.setAttribute('value', 'Отправка...');
      btn.classList.add('disabled');

      if (disableSubmit == true) {
        return false;
      }
      disableSubmit = true;
      return true;
    });
  });

  if (typeof(content_wpcf7) != 'undefined' && content_wpcf7 != null) {
    content_wpcf7.addEventListener( 'wpcf7invalid', event => {
      let btn = content_wpcf7.querySelector('input[type="submit"]');

      btn.setAttribute('value', 'Отправить');
      btn.classList.remove('disabled');
      disableSubmit = false;
    }, false );

    content_wpcf7.addEventListener( 'wpcf7submit', event => {
      let btn = content_wpcf7.querySelector('input[type="submit"]');

      btn.setAttribute('value', 'Отправить');
      btn.classList.remove('disabled');
      disableSubmit = false;
    }, false );
  }

  if (typeof(modal_wpcf7) != 'undefined' && modal_wpcf7 != null) {
    modal_wpcf7.addEventListener( 'wpcf7invalid', event => {
      let btn = modal_wpcf7.querySelector('input[type="submit"]');

      btn.setAttribute('value', 'Отправить');
      btn.classList.remove('disabled');
      disableSubmit = false;
    }, false );

    modal_wpcf7.addEventListener( 'wpcf7submit', event => {
      let btn = modal_wpcf7.querySelector('input[type="submit"]');

      btn.setAttribute('value', 'Отправить');
      btn.classList.remove('disabled');
      disableSubmit = false;
    }, false );
  }
};

export {cf7};
