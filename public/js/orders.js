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

/***/ "./resources/js/orders.js":
/*!********************************!*\
  !*** ./resources/js/orders.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var DatatablesAjax = function () {
  var handleWarehouse = function handleWarehouse() {
    if (!$().dataTable) {
      return;
    }

    var grid = new Datatable();
    grid.init({
      src: $("#order_warehouse"),
      onSuccess: function onSuccess(grid, response) {// grid:        grid object
        // response:    json object of server side ajax response
        // execute some code after table records loaded
      },
      onError: function onError(grid) {// execute some code on network or other general error  
      },
      onDataLoad: function onDataLoad(grid) {
        // execute some code on ajax data load                
        $(".tracking_no").inputmask({
          "mask": ["####-####-####", "9999-9999-9999", "9999-9999-9999-999"]
        });
        return true;
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
          // "orderable": false,                 
          // "render":function(data, type, full, meta){                            
          //     return '<i class="fa fa-circle green"></i>';
          // },
          // className: 'dt-body-center',
          visible: false
        }, {
          "targets": 2,
          "orderable": false,
          "render": function render(data, type, full, meta) {
            $res = "";

            if (data) {
              $.each(data, function (key, elem) {
                var status = elem[2].split(":");

                if (status[0] == "Not picked up") {
                  $res += '<i class="fa fa-circle red" data-toggle="tooltip" data-theme="dark" title="' + elem[0] + ': 集まらない"></i>';
                } else if (status[0] == "On vehicle for delivery") {
                  $res += '<i class="fa fa-circle orange" data-toggle="tooltip" data-theme="dark" title="' + elem[0] + ': 輸送中"></i>';
                } else if (status[0] == "Delivered") {
                  $res += '<i class="fa fa-circle green" data-toggle="tooltip" data-theme="dark" title="' + elem[0] + ': 配達完了 - ' + elem[1] + '"></i>';
                } else if (status[0] == "Exception") {
                  $res += '<i class="fa fa-circle grey" data-toggle="tooltip" data-theme="dark" title="' + elem[0] + ': お問合せ - ' + elem[1] + '"></i>';
                } else {
                  $res += '<i class="fa fa-circle" data-toggle="tooltip" data-theme="dark" title="' + elem[0] + ': 該当なし"></i>';
                }
              });
            }

            return $res;
          },
          className: 'dt-body-center tracking_status'
        }, {
          "targets": -1,
          "render": function render(data, type, full, meta) {
            if (data == null) data = '';
            var tracking_no_input = '<div class="input-group tracking_box" order-id="' + full[0] + '">';
            tracking_no_input += '<div><select class="form-control input-small input-sm input-inline mr-10">';
            $.each(data.split(','), function (key, elem) {
              if (elem) {
                tracking_no_input += "<option>" + elem + "</option>";
              }
            });
            tracking_no_input += "</select>"; // + "<a class='add_track'><i class='fa fa-plus-circle'></i></a></div>";

            tracking_no_input += '<div><input type="text" class="form-control input-sm input-small tracking_no input-inline" name="tracking_no" placeholder="">' + '<span class="input-group-btn">' + '<button class="btn blue btn-sm" txt="change" type="button">保存</button>' + '</span>' + '</div>';
            tracking_no_input += '</div>';
            return tracking_no_input;
          },
          className: 'product_tracking tracking_number'
        }, {
          "targets": -2,
          visible: false // "render":function(data){
          //     return "¥" + data;
          // },
          // className: 'dt-body-right',

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
      if ($(e.target).closest("td").hasClass("product_tracking")) {
        return;
      }

      e.preventDefault();

      if ($(this).hasClass("open")) {
        $(this).removeClass("open");
        $(this).next().fadeOut(100, function () {
          $(this).remove();
        });
      } else {
        table.find('tbody tr').removeClass("open");
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
            function assign_product(_this) {
              $.ajax({
                url: '/ajax_product_tracking',
                type: 'post',
                data: {
                  product_id: $(this).closest("tr").attr("product-id"),
                  tracking_no: $(_this).val()
                },
                dataType: 'json',
                success: function success(res) {
                  if (res.success == true) {
                    toastr["success"](res.msg, "成功!");
                  } else {
                    toastr["error"](res.msg, "失敗!");
                  }
                }
              });
            }

            ;
            var p_html = "<tr class='child'><td class='child' colspan='" + the.find('>td').length + "'><table class='table table-bordered po_details'>";
            p_html += "<thead><tr>" + "<td class='nowrap'>ASIN</td>" + "<td class='nowrap'>製品コード</td>" + "<td class='nowrap'>モデル番号</td>" + "<td class='nowrap'>商品名</td>" + "<td class='nowrap'>在庫</td>" + "<td class='nowrap'>入荷待ち</td>" + "<td class='nowrap'>ウィンドウの種類</td>" + "<td class='nowrap'>予定日</td>" + "<td class='nowrap'>依頼数量</td>" + "<td class='nowrap'>承認済みの数量</td>" + "<td class='nowrap'>受領済みの数量</td>" + "<td class='nowrap'>未処理の数量</td>" + "<td class='nowrap'>お問合せ番号</td>" + "</tr></thead><tbody>";
            $.each(res.products, function (key, product) {
              var option = "<option></option>";

              if (res.tracking_number) {
                $.each(res.tracking_number.split(","), function (key, ele) {
                  if (ele) {
                    if (product.tracking_no == ele) {
                      option += "<option value='" + ele + "' selected>" + ele + "</option>";
                    } else {
                      option += "<option value='" + ele + "'>" + ele + "</option>";
                    }
                  }
                });
              }

              var tracking_no_box = "<select class='form-control input-small input-sm input-inline'>" + option + "</select>";

              if (!product.stock) {
                product.stock = 10;
              }

              p_html += "<tr product-id='" + product.id + "'><td>" + product.asin + "</td>" + "<td>" + product.external_id + "</td>" + "<td>" + product.mordel_number + "</td>" + "<td>" + product.title + "</td>" + "<td>" + product.stock + "</td>" + "<td>" + (product.blockordered ? product.blockordered : '') + "</td>" + "<td>" + product.window_type + "</td>" + "<td>" + product.expected_date + "</td>" + "<td>" + product.quantity_request + "</td>" + "<td>" + product.accepted_quantity + "</td>" + "<td>" + product.quantity_received + "</td>" + "<td>" + product.quantity_outstand + "</td>" + "<td class='product_tracking'>" + tracking_no_box + "</td></tr>";
            });
            p_html += "</tbody></table></td></tr>";
            $(p_html).fadeIn(100, function () {
              $(this).find(".product_tracking select").change(function () {
                $.ajax({
                  url: '/ajax_product_tracking',
                  type: 'post',
                  data: {
                    order_id: data_id,
                    product_id: $(this).closest("tr").attr("product-id"),
                    tracking_no: $(this).val()
                  },
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
    $(".data-picker").append(trader_box).append(date_slider).append(datepicker);
    date_slider.bootstrapToggle(); // table.on('click', '.tracking_box a.add_track', function(e) {
    //     var tracking_box = $(this).parent().parent();
    //     if(tracking_box.find("div>input").length <=0){
    //         tracking_box.append(
    //             '<div><input type="text" class="form-control input-sm input-small tracking_no input-inline" name="tracking_no" placeholder="0000-0000-0000">'+
    //                 '<span class="input-group-btn">'+
    //                     '<button class="btn blue btn-sm" txt="change" type="button">保存</button>'+
    //                 '</span>'+
    //             '</div>'
    //         ); 
    //         tracking_box.find(".tracking_no").inputmask("mask", {
    //             "mask": "9999-9999-9999"
    //         });                                   
    //     }            
    // });

    table.on('click', '.tracking_box button', function (e) {
      var tracking_box = $(this).closest('.tracking_box');
      var the = $(this); // if( $(this).attr('txt') == "change" ){
      //     $(this).attr('txt', "confirm");
      //     $(this).text("確認");
      //     $(this).removeClass('blue');
      //     $(this).addClass('green');
      //     tracking_box.find("input").prop("readonly", false);
      // }

      if ($(this).attr('txt') == "change") {
        $.ajax({
          type: "post",
          url: '/ajax_tracking_update',
          data: {
            order_id: tracking_box.attr('order-id'),
            tracking_no: tracking_box.find("input").val()
          },
          success: function success(res) {
            if (res.success == true) {
              tracking_box.find("select").prepend("<option selected>" + tracking_box.find("input").val() + "</option>");
              toastr["success"](res.msg, "成功!");
            } else {
              toastr["error"](res.msg, "失敗!");
            } //the.parent().parent().remove();
            // the.attr('txt', "change");
            // the.text("保存");
            // the.removeClass('green');
            // the.addClass('blue');
            // tracking_box.find("input").prop("readonly", true);

          }
        });
      }
    });
  };

  return {
    //main function to initiate the module
    init: function init() {
      handleWarehouse();
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

/***/ 3:
/*!**************************************!*\
  !*** multi ./resources/js/orders.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /media/benz/Source/Benz/Husqvarna/husqvarna/resources/js/orders.js */"./resources/js/orders.js");


/***/ })

/******/ });