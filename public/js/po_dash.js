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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/po_dash.js":
/*!*********************************!*\
  !*** ./resources/js/po_dash.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var DatatablesAjax = function () {
  var handleDashboard = function handleDashboard() {
    if (!$().dataTable) {
      return;
    }

    var grid = new Datatable();
    grid.init({
      src: $("#order_po"),
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
        "dom": "<'row'<'col-md-4 col-sm-12'pli><'col-md-4 col-sm-12'<'po-data-picker'>><'col-md-4 col-sm-12'f>r>t<'row'<'col-md-4 col-sm-12'pli><'col-md-4 col-sm-12'><'col-md-4 col-sm-12'>>",
        "bStateSave": true,
        "bFilter": true,
        "bInfo": true,
        //"bProcessing" : true,
        "bSortable": true,
        "bPaginate": true,
        // read the custom filters from saved state and populate the filter inputs
        "fnStateSaveParams": function fnStateSaveParams(oSettings, sValue) {},
        // read the custom filters from saved state and populate the filter inputs
        "fnStateLoadParams": function fnStateLoadParams(oSettings, oData) {
          oData.search.search = "";
          oData.order = [5, "desc"];
          return true;
        },
        "lengthMenu": [[10, 20, 50, 100, 150, -1], [10, 20, 50, 100, 150, "All"] // change per page values here
        ],
        "pageLength": 20,
        // default record count per page
        "ajax": {
          "url": "/ajax_dashbaord" // ajax source

          /*"dataSrc": function(res){
               for ( var i=0, ien=res.data.length ; i<ien ; i++ ) {
                  
                  res.data[i] = $.map(res.data[i], function(value, index) {                                            
                                  return [value];
                                });
              }         
               App.unblockUI(table.parents(".table-container"));
                              return res.data;                        
          }*/

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
          $(row).attr('data-id', data[0]);
        },
        "columnDefs": [{
          "targets": 0,
          visible: false
        }, {
          "targets": 1,
          "orderable": false,
          "render": function render(data, type, full, meta) {
            return '<i class="fa fa-circle green"></i>';
          },
          className: 'dt-body-center'
        }, {
          "targets": 2,
          "orderable": false,
          "render": function render(data, type, full, meta) {
            return '<i class="fa fa-circle red"></i>';
          },
          className: 'dt-body-center'
        }, {
          "targets": 3,
          "render": function render(data, type, full, meta) {
            return '<a href="/order/' + data + '">' + data + '</a>';
          }
        }, {
          "targets": -1,
          "data": null,
          "orderable": false,
          "defaultContent": '<div class="btn-group pull-right">' + '<button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作' + '<i class="fa fa-angle-down"></i>' + '</button>' + '<ul class="dropdown-menu pull-right">' + '<li>' + '<a href="javascript:;" class="edit">' + '<i class="fa fa-edit"></i>編集</a>' + '</li>' + '<li>' + '<a href="javascript:;" class="delete" >' + '<i class="fa fa-remove"></i> 削除 </a>' + '</li>' + '</ul>' + '</div>'
        }, {
          "targets": -3,
          "render": function render(data) {
            if (data) {
              return "¥" + data;
            }

            return data;
          },
          className: 'dt-body-right'
        }],
        "ordering": true,
        "order": [[5, "desc"]] // set first column as a default sort by asc                

      }
    });
    var table = grid.getTable();
    table.on('click', '.delete', function (e) {
      e.preventDefault();
      var nRow = $(this).parents('tr');
      var data_id = $(nRow).attr("data-id");
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
          grid.getDataTable().ajax.reload();
          swal("削除しました!", "", "success");
        } else {
          swal("キャンセル", "", "error");
        }
      });
    });
    table.on('click', 'tbody tr', function (e) {
      if ($(this).find(">td").eq(2).text() == $(e.target).text()) {
        return;
      }

      e.preventDefault();

      if ($(this).hasClass("open")) {
        $(this).removeClass("open");
        $(this).next().fadeOut(100, function () {
          $(this).remove();
        });
      } else {
        var data_id = $(this).attr("data-id");
        var the = $(this);
        table.find("tbody tr.child").fadeOut(100, function () {
          $(this).remove();
        });
        $.ajax({
          url: '/ajax_order_products',
          type: 'post',
          data: {
            order_id: data_id
          },
          dataType: 'json',
          success: function success(res) {
            //console.log(res);
            var p_html = "<tr class='child'><td class='child' colspan='" + the.find('>td').length + "'><table class='table table-bordered'>";
            p_html += "<thead><tr>" + "<td class='nowrap'>ASIN</td>" + "<td class='nowrap'>製品コード</td>" + "<td class='nowrap'>モデル番号</td>" + "<td class='nowrap'>商品名</td>" + "<td class='nowrap'>入荷待ち</td>" + "<td class='nowrap'>ウィンドウの種類</td>" + "<td class='nowrap'>予定日</td>" + "<td class='nowrap'>依頼数量</td>" + "<td class='nowrap'>承認済みの数量</td>" + "<td class='nowrap'>受領済みの数量</td>" + "<td class='nowrap'>未処理の数量</td>" + "<td class='nowrap'>仕入価格</td>" + "<td class='nowrap'>総額</td>" + "</tr></thead><tbody>";
            $.each(res, function (key, product) {
              p_html += "<tr><td>" + product.asin + "</td>" + "<td>" + product.external_id + "</td>" + "<td>" + product.mordel_number + "</td>" + "<td>" + product.title + "</td>" + "<td>" + product.blockordered + "</td>" + "<td>" + product.window_type + "</td>" + "<td>" + product.expected_date + "</td>" + "<td>" + product.quantity_request + "</td>" + "<td>" + product.accepted_quantity + "</td>" + "<td>" + product.quantity_received + "</td>" + "<td>" + product.quantity_outstand + "</td>" + "<td>" + product.unit_cost + "</td>" + "<td>" + product.total_cost + "</td></tr>";
            });
            p_html += "</tbody></table></td></tr>";
            $(p_html).fadeIn(100, function () {
              $(this).insertAfter(the);
            });
            the.addClass("open");
          }
        });
      }
    });
    var init_date = init_daterange();
    var start_date_val = init_date[0];
    var end_date_val = init_date[1];
    var datepicker = $("<input>", {
      'class': 'form-control input-xs input-sm input-inline ml-10',
      'type': 'text',
      'name': 'po_date_range',
      'value': init_date[0] + ' - ' + init_date[1],
      'disabled': true
    }).daterangepicker({
      opens: 'left',
      locale: {
        format: 'YYYY/MM/DD',
        applyLabel: "適用",
        cancelLabel: "キャンセル",
        daysOfWeek: ["日", "月", "火", "水", "木", "金", "土"],
        monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
      }
    }, function (start, end, label) {
      start_date_val = start.format('YYYY-MM-DD');
      end_date_val = end.format('YYYY-MM-DD');
      console.log(start_date_val);
      grid.setAjaxParam("start_date_val", start.format('YYYY-MM-DD'));
      grid.setAjaxParam("end_date_val", end.format('YYYY-MM-DD'));
      grid.ajax_reload();
    });
    var date_slider = $("<input>", {
      "id": "po_on_off",
      "type": "checkbox",
      "checked": false,
      'data-toggle': "toggle",
      'data-on': "期間",
      'data-off': "全部",
      'data-onstyle': "primary",
      'data-offstyle': "danger",
      change: function change(e) {
        if ($(this).prop("checked")) {
          grid.setAjaxParam("start_date_val", start_date_val);
          grid.setAjaxParam("end_date_val", end_date_val);
          datepicker.prop('disabled', false);
        } else {
          grid.setAjaxParam("start_date_val", '');
          grid.setAjaxParam("end_date_val", '');
          datepicker.prop('disabled', true);
        }

        grid.ajax_reload();
      }
    });
    var trader_box = $('<select>', {
      "class": 'form-control input-sm input-xsmall input-inline mr-30',
      name: 'trader_type',
      id: 'trader_box',
      html: '<option value="">全部</option><option value="gardena">ガルデナ</option><option value="husqvarna">ハスクバーナ</option>',
      change: function change(e) {
        grid.setAjaxParam("trader_type", $(this).val());
        grid.ajax_reload();
      }
    });
    $(".po-data-picker").append(trader_box).append(date_slider).append(datepicker);
    date_slider.bootstrapToggle();
  };

  var handleDirect = function handleDirect() {
    if (!$().dataTable) {
      return;
    }

    var grid = new Datatable();
    grid.init({
      src: $("#order_direct"),
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
        "pageLength": 20,
        // default record count per page
        "ajax": {
          "url": "/ajax_direct_order" // ajax source

          /*"dataSrc": function(res){
               for ( var i=0, ien=res.data.length ; i<ien ; i++ ) {
                  
                  res.data[i] = $.map(res.data[i], function(value, index) {                                            
                                  return [value];
                                });
              }         
               App.unblockUI(table.parents(".table-container"));
                              return res.data;                        
          }*/

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
          $(row).attr('data-id', data[0]);
        },
        "columnDefs": [{
          "targets": 0,
          visible: false
        }, {
          "targets": 17,
          "render": function render(data) {
            if (data) {
              return "¥" + data;
            }

            return data;
          },
          className: 'dt-body-right'
        }, {
          "targets": -1,
          "data": null,
          "orderable": false,
          "defaultContent": '<div class="btn-group pull-right">' + '<button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作' + '<i class="fa fa-angle-down"></i>' + '</button>' + '<ul class="dropdown-menu pull-right">' + '<li>' + '<a href="javascript:;" class="edit">' + '<i class="fa fa-edit"></i>編集</a>' + '</li>' + '<li>' + '<a href="javascript:;" class="delete" >' + '<i class="fa fa-remove"></i> 削除 </a>' + '</li>' + '</ul>' + '</div>'
        }],
        "ordering": true,
        "order": [[3, "asc"]] // set first column as a default sort by asc

      }
    });
    var table = grid.getTable();
    table.on('click', '.delete', function (e) {
      e.preventDefault();
      var nRow = $(this).parents('tr');
      var data_id = $(nRow).attr("data-id");
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
          grid.getDataTable().ajax.reload();
          swal("削除しました!", "", "success");
        } else {
          swal("キャンセル", "", "error");
        }
      });
    });
    var init_date = init_daterange();
    var start_date_val = init_date[0];
    var end_date_val = init_date[1];
    var datepicker = $("<input>", {
      'class': 'form-control input-xs input-sm input-inline ml-10',
      'type': 'text',
      'name': 'po_date_range',
      'value': init_date[0] + ' - ' + init_date[1],
      'disabled': false
    }).daterangepicker({
      opens: 'left',
      locale: {
        format: 'YYYY/MM/DD',
        applyLabel: "適用",
        cancelLabel: "キャンセル",
        daysOfWeek: ["日", "月", "火", "水", "木", "金", "土"],
        monthNames: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
      }
    }, function (start, end, label) {
      start_date_val = start.format('YYYY-MM-DD');
      end_date_val = end.format('YYYY-MM-DD');
      console.log(start_date_val);
      grid.setAjaxParam("start_date_val", start.format('YYYY-MM-DD'));
      grid.setAjaxParam("end_date_val", end.format('YYYY-MM-DD'));
      grid.ajax_reload();
    });
    var date_slider = $("<input>", {
      "id": "po_on_off",
      "type": "checkbox",
      "checked": false,
      'data-toggle': "toggle",
      'data-on': "期間",
      'data-off': "全部",
      'data-onstyle': "primary",
      'data-offstyle': "danger",
      change: function change(e) {
        if ($(this).prop("checked")) {
          grid.setAjaxParam("start_date_val", '');
          grid.setAjaxParam("end_date_val", '');
          datepicker.prop('disabled', true);
        } else {
          grid.setAjaxParam("start_date_val", start_date_val);
          grid.setAjaxParam("end_date_val", end_date_val);
          datepicker.prop('disabled', false);
        }

        grid.ajax_reload();
      }
    });
    $(".data-picker").append(date_slider).append(datepicker);
    date_slider.bootstrapToggle();
  };

  return {
    //main function to initiate the module
    init: function init() {
      handleDashboard();
      handleDirect();
    }
  };
}();

var init_daterange = function init_daterange() {
  var d = new Date();
  var month = d.getMonth() + 1;
  var day = d.getDate();
  var from = d.getFullYear() + '/' + (month < 10 ? '0' : '') + month + '/' + '01';
  var to = d.getFullYear() + '/' + (month < 10 ? '0' : '') + month + '/' + (day < 10 ? '0' : '') + day;
  return [from, to];
};

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

/***/ 2:
/*!***************************************!*\
  !*** multi ./resources/js/po_dash.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /media/benz/Source/Benz/Husqvarna/husqvarna/resources/js/po_dash.js */"./resources/js/po_dash.js");


/***/ })

/******/ });