import {disableBodyScroll, enableBodyScroll} from '../vendor/body-scroll-lock';

const openModal = (modal, callback, preventScrollLock) => {
  modal.classList.add('modal--active');

  if (callback) {
    callback();
  }

  document.body.classList.add('overlay-visible');

  if (!preventScrollLock) {
    window.disableBodyScroll(modal, {
      reserveScrollBarGap: true,
    });
  }
};

const closeModal = (modal, callback, preventScrollLock) => {
  modal.classList.remove('modal--active');

  if (callback) {
    callback();
  }

  document.body.classList.remove('overlay-visible');

  if (!preventScrollLock) {
    setTimeout(() => {
      window.enableBodyScroll(modal);
    }, 300);
  }
};

const onEscPress = (evt, modal, callback) => {
  const isEscKey = evt.key === 'Escape' || evt.key === 'Esc';

  if (isEscKey && modal.classList.contains('modal--active')) {
    evt.preventDefault();
    closeModal(modal, callback);
  }
};

const setModalListeners = (modal, closeCallback, preventScrollLock) => {
  const overlay = document.querySelector('.modal__overlay');
  const closeBtn = modal.querySelector('.modal__close-btn');

  closeBtn.addEventListener('click', () => {
    closeModal(modal, closeCallback, preventScrollLock);
  });

  overlay.addEventListener('click', () => {
    closeModal(modal, closeCallback, preventScrollLock);
  });

  document.addEventListener('keydown', (evt) => {
    onEscPress(evt, modal, closeCallback, preventScrollLock);
  });
};

const setupModal = (modal, closeCallback, modalBtn, openCallback, noPrevDefault, preventScrollLock) => {
  if (modalBtn) {
    modalBtn.addEventListener('click', (evt) => {
      if (!noPrevDefault) {
        evt.preventDefault();
      }
      openModal(modal, openCallback, preventScrollLock);
    });
  }

  setModalListeners(modal, closeCallback, preventScrollLock);
};

export {setupModal, openModal, closeModal};
