/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************************************************!*\
  !*** ./assets/components/bitrix/system.auth.form/.default/script.js ***!
  \**********************************************************************/
document.addEventListener('DOMContentLoaded', function () {
  var isFormProcessed = false;
  var authForm = document.forms["custom-auth-form"];
  if (!authForm) return false;
  var errors = authForm.querySelector('.custom-auth__errors');
  authForm.addEventListener('submit', function (e) {
    e.preventDefault();
    if (isFormProcessed) return false;

    var clearErrors = function clearErrors() {
      if (errors) errors.innerHTML = '';
    };

    var showErrors = function showErrors(errorMsgs) {
      if (errors) errors.innerHTML = Object.values(errorMsgs).join('<br>\n');
    };

    var afterSubmit = function afterSubmit(call) {
      isFormProcessed = false;
      console.log('@todo preloader stop');
      call();
    };

    isFormProcessed = true;
    console.log('@todo preloader start');
    clearErrors();
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (4 === xhr.readyState) {
        var response = JSON.parse(xhr.response);

        if (200 === xhr.status) {
          if ('Y' === response.SUCCESS) {
            return afterSubmit(function () {
              console.log(response.BACKURL);

              if (response.BACKURL) {
                window.location.href = response.BACKURL;
              } else {
                window.location.reload();
              }
            });
          }
        }

        return afterSubmit(function () {
          showErrors(response.ERRORS);
        });
      }
    };

    xhr.open('POST', e.target.getAttribute('action') || './');
    xhr.send(new FormData(e.target));
  });
});
/******/ })()
;