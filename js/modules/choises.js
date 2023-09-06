import Choices from '../../src/libs/node_modules/choices.js';

const choices = () => {
  const selects = document.querySelectorAll('.form-choices');

  selects.forEach(select => {
    const choices = new Choices(select, {
      itemSelectText: '',
      shouldSort: false,
    });
  });
};

export {choices};