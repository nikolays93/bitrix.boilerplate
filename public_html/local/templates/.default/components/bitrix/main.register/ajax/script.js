/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************************************************!*\
  !*** ./assets/components/bitrix/main.register/.default/script.js ***!
  \*******************************************************************/
document.addEventListener('DOMContentLoaded', function () {
  var registerFormEl = document.querySelector('.form-main-register');
  if (!registerFormEl) return;
  var errors = registerFormEl.querySelector('[data-role="error-messages"]');
  var success = registerFormEl.querySelector('[data-role="success-messages"]'); //
  // Captcha
  //

  var captchaEl = registerFormEl.querySelector('[data-role="captcha-field"]');

  if (captchaEl) {
    var captchaImageEl = captchaEl.querySelector('img');
    captchaEl.addEventListener('click', function (e) {
      if ('IMG' !== e.target.tagName.toUpperCase()) return;
      var xhr = new XMLHttpRequest();

      xhr.onreadystatechange = function () {
        if (4 === xhr.readyState) {
          var response = JSON.parse(xhr.response);

          if (200 === xhr.status) {
            captchaEl.innerHTML = response.CAPTCHA_HTML;
          }
        }
      };

      xhr.open('GET', './?action=getCaptcha&ajax=1');
      xhr.send();
    });
  } //
  // Submit
  //


  var isFormProcessed = false;
  registerFormEl.addEventListener('submit', function (e) {
    e.preventDefault();
    if (isFormProcessed) return false;

    var clearErrors = function clearErrors() {
      if (errors) errors.innerHTML = '';
    };

    var showErrors = function showErrors(errorMsgs) {
      if (errors) errors.innerHTML = Object.values(errorMsgs).join('<br>\n');
    };

    var beforeSubmit = function beforeSubmit() {
      return console.log('@todo preloader start');
    };

    var afterSubmit = function afterSubmit() {
      return console.log('@todo preloader stop');
    };

    var getFormData = function getFormData(form) {
      var data = new FormData(form);
      data.append('ajax', 1);
      return data;
    };

    var xhr = new XMLHttpRequest();
    beforeSubmit();
    isFormProcessed = true;
    clearErrors();

    xhr.onreadystatechange = function () {
      if (4 === xhr.readyState) {
        var response = JSON.parse(xhr.response);

        if (200 === xhr.status && 'Y' === response.SUCCESS) {
          if (success) success.innerHTML = response.SUCCESS_MESSAGE;
          var fields = registerFormEl.querySelector('.form-fields');
          if (fields) fields.innerHTML = '';
          setTimeout(function () {
            if (response.BACKURL) {
              window.location.href = response.BACKURL;
            } else if (response.AUTH) {
              document.location.reload();
            }
          }, 4000);
        } else {
          showErrors(response.ERRORS);
        }

        isFormProcessed = false;
        afterSubmit();
        if (captchaEl) captchaEl.innerHTML = response.CAPTCHA_HTML;
      }
    };

    xhr.open('POST', e.target.getAttribute('action') || './');
    xhr.send(getFormData(e.target));
  }); //
  // Acept policy.
  //

  var submitEl = registerFormEl.querySelector('[type="submit"]');
  registerFormEl.querySelector('[name="privacy_accept"]').addEventListener('input', function (e) {
    if (e.target.checked) {
      submitEl.classList.remove('disabled');
      submitEl.removeAttribute('disabled');
    } else {
      submitEl.classList.add('disabled');
      submitEl.setAttribute('disabled', 'true');
    }
  });

  window.cloneValue = function (passwordSelector, confirmSelector) {
    var password = registerFormEl.querySelector(passwordSelector);
    var confirm = registerFormEl.querySelector(confirmSelector);

    if (password && confirm) {
      password.addEventListener('keyup', function (e) {
        confirm.value = e.target.value;
      });
      confirm.removeAttribute('readonly');
    }
  };
});
/******/ })()
;