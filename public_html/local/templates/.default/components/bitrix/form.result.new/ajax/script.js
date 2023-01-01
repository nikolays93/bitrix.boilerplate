/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/components/bitrix/form.result.new/ajax/src/Field.js":
/*!********************************************************************!*\
  !*** ./assets/components/bitrix/form.result.new/ajax/src/Field.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// Abstract
var Field = /*#__PURE__*/function () {
  function Field(inputEl, fieldEl, errorEl) {
    _classCallCheck(this, Field);

    _defineProperty(this, "inputEl", null);

    _defineProperty(this, "fieldEl", null);

    _defineProperty(this, "errorEl", null);

    _defineProperty(this, "builtInValue", '');

    _defineProperty(this, "errors", []);

    if (this.constructor == Field) {
      throw new Error("Abstract classes can't be instantiated.");
    }

    if (!inputEl) {
      throw new Error("Input element is required.");
    }

    this.inputEl = inputEl;
    this.fieldEl = fieldEl;
    this.errorEl = errorEl;
    this.builtInValue = inputEl.value;
  }

  _createClass(Field, [{
    key: "getFieldName",
    value: function getFieldName() {
      var labelKeeper = this.inputEl.closest('[aria-label]');
      return labelKeeper ? labelKeeper.getAttribute('aria-label') : '';
    }
  }, {
    key: "notEmpty",
    value: function notEmpty() {
      return this.inputEl.value.length > 0;
    }
  }, {
    key: "isDisabled",
    value: function isDisabled() {
      return this.inputEl.hasAttribute('disabled') && 'false' !== this.inputEl.getAttribute('disabled');
    }
  }, {
    key: "isRequired",
    value: function isRequired() {
      return this.inputEl.hasAttribute('required') && 'false' !== this.inputEl.getAttribute('required');
    }
  }, {
    key: "validateRequired",
    value: function validateRequired() {
      return !this.isRequired() || this.notEmpty();
    }
  }, {
    key: "validate",
    value: function validate() {
      this.errors = [];

      if (this.isRequired() && !this.notEmpty()) {
        this.errors.push('required');
      }

      return !this.errors.length;
    }
  }, {
    key: "getErrors",
    value: function getErrors() {
      return this.errors;
    }
  }, {
    key: "showErrors",
    value: function showErrors(text) {
      if (this.fieldEl) this.fieldEl.classList.add('error');
      if (Array.isArray(text)) text = text.map(function (oneText) {
        return "<span>".concat(oneText, "</span>");
      }).join('\n');
      if (!text) text = '';
      if (text && this.errorEl) this.errorEl.innerHTML = text;
    }
  }, {
    key: "clearErrors",
    value: function clearErrors() {
      if (this.fieldEl) this.fieldEl.classList.remove('error');
      if (this.errorEl) this.errorEl.innerHTML = '';
    }
  }, {
    key: "clearValue",
    value: function clearValue() {
      this.inputEl.value = this.builtInValue;
    }
  }]);

  return Field;
}();

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Field);

/***/ }),

/***/ "./assets/components/bitrix/form.result.new/ajax/src/FieldEmail.js":
/*!*************************************************************************!*\
  !*** ./assets/components/bitrix/form.result.new/ajax/src/FieldEmail.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Field */ "./assets/components/bitrix/form.result.new/ajax/src/Field.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



var FieldEmail = /*#__PURE__*/function (_Field) {
  _inherits(FieldEmail, _Field);

  var _super = _createSuper(FieldEmail);

  function FieldEmail() {
    _classCallCheck(this, FieldEmail);

    return _super.apply(this, arguments);
  }

  _createClass(FieldEmail, [{
    key: "validate",
    value: function validate() {
      _get(_getPrototypeOf(FieldEmail.prototype), "validate", this).call(this); // https://stackoverflow.com/a/46181/7425521


      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      if (this.inputEl.value && !re.test(String(this.inputEl.value).toLowerCase())) {
        this.errors.push('email');
      }

      return !this.errors.length;
    }
  }]);

  return FieldEmail;
}(_Field__WEBPACK_IMPORTED_MODULE_0__["default"]);

_defineProperty(FieldEmail, "defaultSelector", 'input[type="email"]');

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FieldEmail);

/***/ }),

/***/ "./assets/components/bitrix/form.result.new/ajax/src/FieldFile.js":
/*!************************************************************************!*\
  !*** ./assets/components/bitrix/form.result.new/ajax/src/FieldFile.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Field */ "./assets/components/bitrix/form.result.new/ajax/src/Field.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _classPrivateMethodInitSpec(obj, privateSet) { _checkPrivateRedeclaration(obj, privateSet); privateSet.add(obj); }

function _checkPrivateRedeclaration(obj, privateCollection) { if (privateCollection.has(obj)) { throw new TypeError("Cannot initialize the same private elements twice on an object"); } }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classPrivateMethodGet(receiver, privateSet, fn) { if (!privateSet.has(receiver)) { throw new TypeError("attempted to get private field on non-instance"); } return fn; }



var _validateSize = /*#__PURE__*/new WeakSet();

var _validateType = /*#__PURE__*/new WeakSet();

var FieldFile = /*#__PURE__*/function (_Field) {
  _inherits(FieldFile, _Field);

  var _super = _createSuper(FieldFile);

  function FieldFile() {
    var _this;

    _classCallCheck(this, FieldFile);

    for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
      args[_key] = arguments[_key];
    }

    _this = _super.call.apply(_super, [this].concat(args));

    _classPrivateMethodInitSpec(_assertThisInitialized(_this), _validateType);

    _classPrivateMethodInitSpec(_assertThisInitialized(_this), _validateSize);

    _defineProperty(_assertThisInitialized(_this), "allowedTypes", ['image/jpeg', 'image/png', 'image/plain', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingm', 'application/pdf']);

    _defineProperty(_assertThisInitialized(_this), "size", 10485760);

    return _this;
  }

  _createClass(FieldFile, [{
    key: "validate",
    value: function validate() {
      if (this.inputEl.files.length) {
        for (file in this.inputEl.files) {
          if (!_classPrivateMethodGet(this, _validateSize, _validateSize2).call(this, file)) this.errors.push('fileSize');
          if (!_classPrivateMethodGet(this, _validateType, _validateType2).call(this, file)) this.errors.push('fileType');
        }
      }

      return !this.errors.length;
    }
  }]);

  return FieldFile;
}(_Field__WEBPACK_IMPORTED_MODULE_0__["default"]);

function _validateSize2(file) {
  return file.size <= this.size;
}

function _validateType2(file) {
  return !!this.allowedTypes.filter(function (type) {
    return type === file.type;
  }).length;
}

_defineProperty(FieldFile, "defaultSelector", 'input[type="file"]');

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FieldFile);

/***/ }),

/***/ "./assets/components/bitrix/form.result.new/ajax/src/FieldPhone.js":
/*!*************************************************************************!*\
  !*** ./assets/components/bitrix/form.result.new/ajax/src/FieldPhone.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Field */ "./assets/components/bitrix/form.result.new/ajax/src/Field.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _get(target, property, receiver) { if (typeof Reflect !== "undefined" && Reflect.get) { _get = Reflect.get; } else { _get = function _get(target, property, receiver) { var base = _superPropBase(target, property); if (!base) return; var desc = Object.getOwnPropertyDescriptor(base, property); if (desc.get) { return desc.get.call(receiver); } return desc.value; }; } return _get(target, property, receiver || target); }

function _superPropBase(object, property) { while (!Object.prototype.hasOwnProperty.call(object, property)) { object = _getPrototypeOf(object); if (object === null) break; } return object; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



var FieldPhone = /*#__PURE__*/function (_Field) {
  _inherits(FieldPhone, _Field);

  var _super = _createSuper(FieldPhone);

  function FieldPhone() {
    _classCallCheck(this, FieldPhone);

    return _super.apply(this, arguments);
  }

  _createClass(FieldPhone, [{
    key: "notEmpty",
    value: function notEmpty() {
      // not '+7 ('
      return this.inputEl.value.length > 4;
    }
  }, {
    key: "validate",
    value: function validate() {
      _get(_getPrototypeOf(FieldPhone.prototype), "validate", this).call(this);

      if (this.inputEl.value && !/\+7\s?\({0,1}9[0-9]{2}\){0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}/.test(this.inputEl.value)) {
        this.errors.push('phone');
      }

      return !this.errors.length;
    }
  }]);

  return FieldPhone;
}(_Field__WEBPACK_IMPORTED_MODULE_0__["default"]);

_defineProperty(FieldPhone, "defaultSelector", 'input[type="tel"]');

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FieldPhone);

/***/ }),

/***/ "./assets/components/bitrix/form.result.new/ajax/src/FieldText.js":
/*!************************************************************************!*\
  !*** ./assets/components/bitrix/form.result.new/ajax/src/FieldText.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _Field__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Field */ "./assets/components/bitrix/form.result.new/ajax/src/Field.js");
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); if (superClass) _setPrototypeOf(subClass, superClass); }

function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }

function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }

function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }



var FieldText = /*#__PURE__*/function (_Field) {
  _inherits(FieldText, _Field);

  var _super = _createSuper(FieldText);

  function FieldText() {
    _classCallCheck(this, FieldText);

    return _super.apply(this, arguments);
  }

  return FieldText;
}(_Field__WEBPACK_IMPORTED_MODULE_0__["default"]);

_defineProperty(FieldText, "defaultSelector", 'input[type="text"], input:not([type])');

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FieldText);

/***/ }),

/***/ "./assets/components/bitrix/form.result.new/ajax/src/Form.js":
/*!*******************************************************************!*\
  !*** ./assets/components/bitrix/form.result.new/ajax/src/Form.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var Form = /*#__PURE__*/function () {
  // Double click protected
  function Form(element, FieldTypeList) {
    var _this = this;

    var args = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};

    _classCallCheck(this, Form);

    _defineProperty(this, "isFormProcessed", false);

    _defineProperty(this, "element", null);

    _defineProperty(this, "fields", {});

    _defineProperty(this, "args", {});

    this.args = _objectSpread({
      field: 'label',
      error: '.message'
    }, args);
    this.element = element;

    var _loop = function _loop() {
      var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
          type = _Object$entries$_i[0],
          selector = _Object$entries$_i[1];

      _this.fields[type] = Array.from(element.querySelectorAll(selector)).map(function (el) {
        var fieldEl = el.closest(_this.args.field);
        var errorEl = fieldEl ? fieldEl.querySelector(_this.args.error) : null;
        return FieldTypeList.fieldByType(type, el, fieldEl, errorEl);
      });
    };

    for (var _i = 0, _Object$entries = Object.entries(FieldTypeList.selectors); _i < _Object$entries.length; _i++) {
      _loop();
    }

    element.addEventListener('submit', this.submit.bind(this));
  }

  _createClass(Form, [{
    key: "validate",
    value: function validate() {
      var fields = this.fetch();
      var incorrectFields = fields.filter(function (field) {
        if (!field.validate()) {
          var fieldName = field.getFieldName().toLowerCase();
          if (fieldName) fieldName += ' ';
          field.showErrors(field.errors.map(function (err) {
            switch (err) {
              case 'required':
                return "\u041F\u043E\u043B\u0435 ".concat(fieldName, "\u043E\u0431\u044F\u0437\u0430\u0442\u0435\u043B\u044C\u043D\u043E");

              case 'email':
                return "\u042D\u043B. \u0430\u0434\u0440\u0435\u0441 \u0432\u0432\u0435\u0434\u0435\u043D \u043D\u0435 \u0432\u0435\u0440\u043D\u043E";

              case 'phone':
                return "\u041D\u043E\u043C\u0435\u0440 \u0442\u0435\u043B\u0435\u0444\u043E\u043D\u0430 \u0432\u0432\u0435\u0434\u0435\u043D \u043D\u0435 \u0432\u0435\u0440\u043D\u043E";

              default:
                return err;
            }
          }));
          return true;
        }

        field.clearErrors();
        return false;
      });
      return incorrectFields.length === 0;
    }
  }, {
    key: "beforeSubmit",
    value: function beforeSubmit() {
      console.log('@todo start preloader');
      this.isFormProcessed = true;
    }
  }, {
    key: "afterSubmit",
    value: function afterSubmit(call) {
      console.log('@todo stop preloader');
      this.isFormProcessed = false;
      return call();
    }
  }, {
    key: "submit",
    value: function submit(e) {
      var _this2 = this;

      e.preventDefault();
      if (this.isFormProcessed) return false;

      if (this.validate()) {
        this.beforeSubmit();
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
          if (4 === xhr.readyState) {
            var response = JSON.parse(xhr.response);

            if (200 === xhr.status) {
              if ('Y' === response.SUCCESS) {
                return _this2.afterSubmit(function () {
                  return _this2.success(response.SUCCESS_MESSAGE);
                });
              }
            }

            return _this2.afterSubmit(function () {
              return _this2.error(response.ERRORS);
            });
          }
        };

        xhr.open('POST', this.element.getAttribute('action') || './');
        xhr.send(new FormData(this.element));
      }
    }
  }, {
    key: "success",
    value: function success(message) {
      this.fetch().map(function (field) {
        return field.clearValue();
      });
      console.log(message);
    }
  }, {
    key: "error",
    value: function error(errors) {
      console.log(errors);
    }
  }, {
    key: "fetch",
    value: function fetch(type) {
      // Get all fields map
      if (!type) return Object.values(this.fields).flat(); // Get by type

      return this.fields.hasOwnProperty(type) ? this.fields[type] : [];
    }
  }]);

  return Form;
}();

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Form);

/***/ }),

/***/ "./assets/components/bitrix/form.result.new/ajax/src/FormFieldTypeList.js":
/*!********************************************************************************!*\
  !*** ./assets/components/bitrix/form.result.new/ajax/src/FormFieldTypeList.js ***!
  \********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classPrivateFieldInitSpec(obj, privateMap, value) { _checkPrivateRedeclaration(obj, privateMap); privateMap.set(obj, value); }

function _checkPrivateRedeclaration(obj, privateCollection) { if (privateCollection.has(obj)) { throw new TypeError("Cannot initialize the same private elements twice on an object"); } }

function _classPrivateFieldGet(receiver, privateMap) { var descriptor = _classExtractFieldDescriptor(receiver, privateMap, "get"); return _classApplyDescriptorGet(receiver, descriptor); }

function _classExtractFieldDescriptor(receiver, privateMap, action) { if (!privateMap.has(receiver)) { throw new TypeError("attempted to " + action + " private field on non-instance"); } return privateMap.get(receiver); }

function _classApplyDescriptorGet(receiver, descriptor) { if (descriptor.get) { return descriptor.get.call(receiver); } return descriptor.value; }

var _fieldTypes = /*#__PURE__*/new WeakMap();

var FormFieldTypeList = /*#__PURE__*/function () {
  function FormFieldTypeList() {
    _classCallCheck(this, FormFieldTypeList);

    _classPrivateFieldInitSpec(this, _fieldTypes, {
      writable: true,
      value: {}
    });

    _defineProperty(this, "selectors", {});
  }

  _createClass(FormFieldTypeList, [{
    key: "registerType",
    value: function registerType(type, className) {
      _classPrivateFieldGet(this, _fieldTypes)[type] = className;
      this.selectors[type] = className.defaultSelector;
      return this;
    }
  }, {
    key: "fieldByType",
    value: function fieldByType(type, inputEl, fieldEl, errorEl) {
      if (!_classPrivateFieldGet(this, _fieldTypes).hasOwnProperty(type)) {
        throw new Error("Not defined field type.");
      }

      return new (_classPrivateFieldGet(this, _fieldTypes)[type])(inputEl, fieldEl, errorEl);
    }
  }]);

  return FormFieldTypeList;
}();

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FormFieldTypeList);

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*****************************************************************!*\
  !*** ./assets/components/bitrix/form.result.new/ajax/script.js ***!
  \*****************************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _src_Form__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./src/Form */ "./assets/components/bitrix/form.result.new/ajax/src/Form.js");
/* harmony import */ var _src_FormFieldTypeList__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./src/FormFieldTypeList */ "./assets/components/bitrix/form.result.new/ajax/src/FormFieldTypeList.js");
/* harmony import */ var _src_FieldText__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./src/FieldText */ "./assets/components/bitrix/form.result.new/ajax/src/FieldText.js");
/* harmony import */ var _src_FieldPhone__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./src/FieldPhone */ "./assets/components/bitrix/form.result.new/ajax/src/FieldPhone.js");
/* harmony import */ var _src_FieldEmail__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./src/FieldEmail */ "./assets/components/bitrix/form.result.new/ajax/src/FieldEmail.js");
/* harmony import */ var _src_FieldFile__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./src/FieldFile */ "./assets/components/bitrix/form.result.new/ajax/src/FieldFile.js");







(function () {
  // Class already exists
  if (window.FormResultNew) return;
  window.FieldTypeList = new _src_FormFieldTypeList__WEBPACK_IMPORTED_MODULE_1__["default"]();
  window.FieldTypeList.registerType('text', _src_FieldText__WEBPACK_IMPORTED_MODULE_2__["default"]).registerType('phone', _src_FieldPhone__WEBPACK_IMPORTED_MODULE_3__["default"]).registerType('email', _src_FieldEmail__WEBPACK_IMPORTED_MODULE_4__["default"]).registerType('file', _src_FieldFile__WEBPACK_IMPORTED_MODULE_5__["default"]);
  window.FormResultNew = _src_Form__WEBPACK_IMPORTED_MODULE_0__["default"];
})();
})();

/******/ })()
;