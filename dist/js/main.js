/******/ (() => { // webpackBootstrap
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
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
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
var CBS_TabbedSlider = /*#__PURE__*/function () {
  function CBS_TabbedSlider() {
    _classCallCheck(this, CBS_TabbedSlider);
    this.init();
  }
  return _createClass(CBS_TabbedSlider, [{
    key: "init",
    value: function init() {
      // Wait until DOM is ready
      document.addEventListener("DOMContentLoaded", function () {
        console.log("DOM loaded");
        var swiper = new Swiper(".tabbedSwiperTabs", {
          loop: true,
          spaceBetween: 0,
          slidesPerView: 4,
          freeMode: true,
          watchSlidesProgress: true,
          breakpoints: {
            768: {
              direction: 'horizontal'
            }
          },
          // Default settings (mobile-first)
          direction: 'vertical'
        });
        var swiper2 = new Swiper(".tabbedSwiper", {
          loop: true,
          spaceBetween: 0,
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
          },
          thumbs: {
            swiper: swiper
          }
        });

        // Initialize the Swiper with proper configuration to avoid scroll conflicts
        // var tabbedSwiper = new Swiper(".tabbedSwiper", {
        //     slidesPerView: 1,
        //     pagination: {
        //       el: ".swiper-pagination",
        //       clickable: true,

        //       renderBullet: function (index, className) {
        //         return '<span class="' + className + '">' + (index + 1) + "</span>";
        //       },

        //     },
        //   });
      });
    }
  }]);
}();
new CBS_TabbedSlider();
})();

// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
(() => {
"use strict";
/*!****************************!*\
  !*** ./src/scss/main.scss ***!
  \****************************/
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin

})();

/******/ })()
;
//# sourceMappingURL=main.js.map