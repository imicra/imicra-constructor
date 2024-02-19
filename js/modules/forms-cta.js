import { fieldsValids } from "./fields-valids";

const formCta = () => {
  const forms = document.querySelectorAll('.form-cta');

  forms.forEach(form => {  
    form.addEventListener('submit', e => {
      e.preventDefault();
      
      // sending form
      if (fieldsValids(form)) {  
        const data = new FormData(form);
        data.append('action', 'imicra_form_cta');
  
        fetch(imicra.ajaxurl, {
          method: 'post',
          body: data
        })
        .then(response => response.text())
        .then(response => {
          response = JSON.parse(response);
  
          if (response) {
            form.querySelector('.form-response-output').innerHTML = response.message;

            // open popup message
            openPopup('success');
  
            // reset form
            if (response.success) {
              form.querySelectorAll('.form-control').forEach(input => {
                input.value = '';
              });
            }
          }
        })
        .catch(error => console.log(error));
      }
    });
  });
};

const closeModal = (modalId) => {
  const modals = document.querySelectorAll(`.modal.${modalId}`);

  modals.forEach(modal => {
    modal.classList.remove('modal--active');
  });
  document.body.classList.remove('overlay-visible');
  document.body.style = null;
}

const openPopup = (modalId) => {
  const modal = document.querySelector(`.modal.${modalId}`);
  const overlay = document.querySelector('.modal__overlay');
  const closeBtn = modal.querySelector('.modal__close-btn');

  setTimeout(() => {
    modal.classList.add('modal--active');
    document.body.classList.add('overlay-visible');
  }, 100);

  closeBtn.addEventListener('click', () => {
    closeModal(modalId);
  });

  overlay.addEventListener('click', () => {
    closeModal(modalId);
  });
}

export {formCta};