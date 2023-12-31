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

export {formCta};