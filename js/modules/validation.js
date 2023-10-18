import Inputmask from '../../src/libs/node_modules/inputmask';
import IMask from '../../src/libs/node_modules/imask';

const formsValidate = () => {
  const telInputs = document.querySelectorAll('input[type=tel]');
  const emailInputs = document.querySelectorAll('input[type=email]');

  telInputs.forEach(element => {
    let maskOptions = {
      mask: "+7(999)999-99-99",
      clearIncomplete: true,
    };
  
    Inputmask(maskOptions).mask(element);
  });

  emailInputs.forEach(element => {
    let maskOptions = {
      mask: function(value) {
        if(/^[a-z0-9_\.-]+$/.test(value))
            return true;
        if(/^[a-z0-9_\.-]+@$/.test(value))
            return true;
        if(/^[a-z0-9_\.-]+@[a-z0-9-]+$/.test(value))
            return true;
        if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.$/.test(value))
            return true;
        if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}$/.test(value))
            return true;
        if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.$/.test(value))
            return true;
        if(/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.[a-z]{1,4}$/.test(value))
            return true;
        return false;
      }
    };
  
    let mask = IMask(element, maskOptions);
  });
};

export {formsValidate};