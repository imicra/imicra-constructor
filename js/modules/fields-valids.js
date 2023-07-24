const fieldsValids = ( form ) => {
  const inputs = form.querySelectorAll('.form-validates-as-required');

  // reset messages for each attempt
  form.querySelectorAll('.form-message').forEach(el => {
    el.textContent = '';
  });

  // validation
  let valids = 0;

  // show/hide errors
  inputs.forEach(el => {
    if (el.value === '') {
      el.classList.add('form-not-valid');
      valids -= 1;
    } else {
      el.classList.remove('form-not-valid');
      valids += 1;
    }
  });

  // console.log(valids);
  return inputs.length === valids;
}

export {fieldsValids};