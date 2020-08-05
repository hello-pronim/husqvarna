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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/api.js":
/*!*****************************!*\
  !*** ./resources/js/api.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

var DatatablesAjax = function () {
  var handleAPI = function handleAPI() {
    if (!$().dataTable) {
      return;
    }

    var grid = new Datatable();
    grid.init({
      src: $("#apis"),
      onSuccess: function onSuccess(grid, response) {// grid:        grid object
        // response:    json object of server side ajax response
        // execute some code after table records loaded
      },
      onError: function onError(grid) {// execute some code on network or other general error  
      },
      onDataLoad: function onDataLoad(grid) {// execute some code on ajax data load
      },
      loadingMessage: '読み込んでいます...',
      dataTable: {
        // here you can define a typical datatable settings from http://datatables.net/usage/options                 
        // save datatable state(pagination, sort, etc) in cookie.
        "dom": "<'row'<'col-md-4 col-sm-12'pli><'col-md-4 col-sm-12'<'data-picker'>><'col-md-4 col-sm-12'f>r>t<'row'<'col-md-4 col-sm-12'pli><'col-md-4 col-sm-12'><'col-md-4 col-sm-12'>>",
        "bStateSave": true,
        "bFilter": true,
        "bInfo": true,
        //"bProcessing" : true,
        "bSortable": false,
        "bPaginate": true,
        "responsive": true,
        // read the custom filters from saved state and populate the filter inputs
        "fnStateSaveParams": function fnStateSaveParams(oSettings, sValue) {},
        // read the custom filters from saved state and populate the filter inputs
        "fnStateLoadParams": function fnStateLoadParams(oSettings, oData) {},
        "lengthMenu": [[10, 20, 50, 100, 150, -1], [10, 20, 50, 100, 150, "All"] // change per page values here
        ],
        "pageLength": 50,
        // default record count per page
        "ajax": {
          "url": "/ajax_get_apis" // ajax source

        },
        "language": {
          "lengthMenu": "&nbsp;<span class='pageLength'>表示数:</span>&nbsp; _MENU_",
          "zeroRecords": "該当する記録が見つかりません。",
          "info": "",
          "infoEmpty": "&nbsp;&nbsp;表示するレコードが見つかりませんでした。",
          "emptyTable": "テーブル内のデータなし。",
          "infoFiltered": "",
          "paginate": {
            "previous": "Prev",
            "next": "Next",
            "last": "Last",
            "first": "First",
            "page": "ぺージ:&nbsp;",
            "pageOf": "&nbsp;"
          },
          "search": "検索:"
        },
        createdRow: function createdRow(row, data, dataIndex) {
          $(row).attr('api-id', data[0]);
        },
        "columnDefs": [{
          "targets": 0,
          visible: false
        }, {
          "targets": 1,
          "orderable": false,
          "render": function render(data, type, full, meta) {
            return '<span class="input-group-btn">' + '<button class="btn ' + (data == "on" ? "green" : data == "check" ? "yellow" : data == "down" ? "red" : "") + ' btn-sm" type="button">' + data.toUpperCase() + '</button>' + '</span>';
          },
          className: 'dt-body-center'
        }, {
          "targets": 2,
          "orderable": false,
          "render": function render(data, type, full, meta) {
            return '<span class="input-group-btn">' + '<button class="btn ' + (data == 1 ? "blue" : "red") + ' btn-sm btn-api-alert" alert="' + data + '" type="button">' + (data == 1 ? "ON" : "OFF") + '</button>' + '</span>';
          },
          className: 'dt-body-center'
        }, {
          "targets": 3,
          "orderable": false,
          "render": function render(data, type, full, meta) {
            var select = "";
            select += '<select class="form-control input-small input-sm input-inline mr-10 select-api-via">';
            select += '<option value="sms"' + (data == "sms" ? 'selected' : '') + '>SMS</option>';
            select += '<option value="email"' + (data == "email" ? 'selected' : '') + '>EML</option>';
            select += '<option value="tel"' + (data == "tel" ? 'selected' : '') + '>TEL</option>';
            select += '</select>';
            return select;
          }
        }, {
          "targets": 4,
          "orderable": false,
          "render": function render(data, type, full, meta) {
            var list = "<div class='api-to-list-container'>";
            list += "<ul class='api-to-list' api-id='" + full[0] + "'>";
            var len = data.length;

            for (var i = 0; i < len; i++) {
              list += "<li>" + data[i].receiver + "</li>";
            }

            list += "</ul>";
            list += "<i class='fa fa-plus-circle'></i>";
            list += "</div>";
            return list;
          }
        }, {
          "targets": -1,
          "render": function render(data, type, full, meta) {
            return data;
          }
        }],
        "ordering": false
      }
    });
    var table = grid.getTable();
    table.on('click', '.api-to-list-container i', function (e) {
      e.preventDefault();
      var api_id = $(this).closest('tr').attr('api-id');
      if (!$(this).parent().find('.api-to-list input').length) $(this).parent().find('.api-to-list').append('<li><div class="flex-row align-items-center"><input class="form-control input-sm input-small input-receiver"><span class="input-group-btn"><button class="btn blue btn-sm btn-add-receiver" type="button" api-id="' + api_id + '">保存</button></span></div></li>');
    });
    table.on('click', '.api-to-list-container button', function (e) {
      e.preventDefault();
      var text = $(this).parent().parent().find('input').val();
      $(this).parent().parent().parent().replaceWith('<li>' + text + '</li>');
    });
    table.on('click', '.btn-api-alert', function (e) {
      e.preventDefault();
      var btn = $(this);
      var alert = $(this).attr('alert');
      var api_id = $(this).closest('tr').attr('api-id');
      $.ajax({
        url: '/ajax_api_alert_update',
        data: {
          alert: 1 - alert,
          api_id: api_id
        },
        type: 'post',
        dataType: 'json',
        success: function success(res) {
          if (res.success == true) {
            if ($(btn).hasClass('blue')) {
              $(btn).removeClass('blue');
              $(btn).addClass('red');
              $(btn).html("OFF");
              $(btn).attr('alert', 0);
            } else {
              $(btn).addClass('blue');
              $(btn).removeClass('red');
              $(btn).html("ON");
              $(btn).attr('alert', 1);
            }

            toastr["success"](res.msg, "成功!");
          } else {
            toastr["error"](res.msg, "失敗!");
          }
        }
      });
    });
    table.on('change', '.select-api-via', function (e) {
      e.preventDefault();
      var select = $(this);
      var via = $(this).val();
      var api_id = $(this).closest('tr').attr('api-id');
      $.ajax({
        url: '/ajax_api_via_update',
        data: {
          via: via,
          api_id: api_id
        },
        type: 'post',
        dataType: 'json',
        success: function success(res) {
          if (res.success == true) {
            toastr["success"](res.msg, "成功!");
          } else {
            toastr["error"](res.msg, "失敗!");
          }
        }
      });
    });
    table.on('click', '.btn-add-receiver', function (e) {
      e.preventDefault();
      var api_id = $(this).attr('api-id');
      var receiver = $(this).parent().parent().find('.input-receiver').val();
      $.ajax({
        url: '/ajax_api_receiver_add',
        data: {
          receiver: receiver,
          api_id: api_id
        },
        type: 'post',
        dataType: 'json',
        success: function success(res) {
          if (res.success == true) {
            toastr["success"](res.msg, "成功!");
          } else {
            toastr["error"](res.msg, "失敗!");
          }
        }
      });
    });
  };

  return {
    //main function to initiate the module
    init: function init() {
      handleAPI();
    }
  };
}();

jQuery(document).ready(function () {
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "positionClass": "toast-top-right",
    "onclick": null,
    "showDuration": "1000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };
  DatatablesAjax.init();
});

/***/ }),

/***/ 3:
/*!***********************************!*\
  !*** multi ./resources/js/api.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\web\Laravel\Huqvarna\husqvarna-amazonapi\resources\js\api.js */"./resources/js/api.js");


/***/ })

/******/ });