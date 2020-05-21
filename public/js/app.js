/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

var DatatablesAjax = function () {
  var initPickers = function initPickers() {
    //init date pickers
    $('.date-picker').datepicker({
      rtl: App.isRTL(),
      autoclose: true
    });
  };

  var handleDashboard = function handleDashboard() {
    var table = $("#dashboard");
    var grid = new Datatable();
    grid.init({
      src: $("#dashboard"),
      onSuccess: function onSuccess(grid, response) {// grid:        grid object
        // response:    json object of server side ajax response
        // execute some code after table records loaded
      },
      onError: function onError(grid) {// execute some code on network or other general error  
      },
      onDataLoad: function onDataLoad(grid) {// execute some code on ajax data load
      },
      loadingMessage: 'Loading...',
      dataTable: {
        // here you can define a typical datatable settings from http://datatables.net/usage/options                 
        // save datatable state(pagination, sort, etc) in cookie.
        "bStateSave": true,
        "lengthMenu": [[10, 20, 50, 100, 150, -1], [10, 20, 50, 100, 150, "All"] // change per page values here
        ],
        "pageLength": 20,
        // default record count per page
        "ajax": {
          "url": "/ajax_dashbaord",
          // ajax source
          "dataSrc": function dataSrc(res) {
            for (var i = 0, ien = res.data.length; i < ien; i++) {
              res.data[i] = $.map(res.data[i], function (value, index) {
                return [value];
              });
            }

            return res.data;
          }
        },
        "language": {
          "lengthMenu": "_MENU_",
          "zeroRecords": "",
          "info": "",
          "infoEmpty": "",
          "infoFiltered": ""
        },
        createdRow: function createdRow(row, data, dataIndex) {
          $(row).attr('data-id', data[0]);
        },
        "columnDefs": [{
          "targets": 0,
          "visible": false
        }, {
          "targets": -1,
          "data": null,
          "defaultContent": '<div class="btn-group pull-right">' + '<button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作' + '<i class="fa fa-angle-down"></i>' + '</button>' + '<ul class="dropdown-menu pull-right">' + '<li>' + '<a href="javascript:;" class="edit">' + '<i class="fa fa-edit"></i>編集</a>' + '</li>' + '<li>' + '<a href="javascript:;" class="delete" >' + '<i class="fa fa-remove"></i> 削除 </a>' + '</li>' + '</ul>' + '</div>'
        }],
        "ordering": false,
        "order": [[1, "asc"]] // set first column as a default sort by asc

      }
    });
    table.on('click', '.delete', function (e) {
      e.preventDefault();
      swal({
        title: "",
        text: "削除しますか？",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "確認",
        cancelButtonText: "キャンセル",
        closeOnConfirm: false,
        closeOnCancel: false
      }, function (isConfirm) {
        if (isConfirm) {
          swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
          swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
      });
      var nRow = $(this).parents('tr')[0];
      grid.fnDeleteRow(nRow);
      alert("Deleted! Do not forget to do some ajax to sync with backend :)");
    });
  };

  return {
    //main function to initiate the module
    init: function init() {
      handleDashboard();
    }
  };
}();

jQuery(document).ready(function () {
  DatatablesAjax.init();
});

/***/ }),

/***/ 1:
/*!***********************************!*\
  !*** multi ./resources/js/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /media/benz/Source/Benz/Husqvarna/husqvarna/resources/js/app.js */"./resources/js/app.js");


/***/ })

/******/ });