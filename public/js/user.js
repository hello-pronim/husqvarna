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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/user.js":
/*!******************************!*\
  !*** ./resources/js/user.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

jQuery(document).ready(function () {
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
  $(".role").change(function () {
    if ($(this).val() == 2) {
      $(".type_role").show();
    } else {
      $(".type_role").hide();
    }
  });
  $("#add_user").on('click', function (e) {
    e.preventDefault();

    if ($('.register-form').validate({
      rules: {
        'email': {
          email: true
        },
        'password': {
          minlength: 8
        },
        'password_confirmation': {
          minlength: 8,
          equalTo: "#password"
        }
      }
    }).form()) {} else {
      console.log("eeee");
      return false;
    }

    $username = $(this).find('input[name="username"]');
    var url = '/register_nl';
    $.ajax({
      type: "post",
      url: url,
      data: $(this).closest("form.register-form").serialize() + '&_token=' + $("input[name='_token']").val(),
      dataType: "json",
      success: function success(res) {
        console.log(res);

        if (res.success) {
          toastr["success"]("更新されました", "成功!");
          window.location.reload();
        } else {
          toastr["error"]("失敗した!", "失敗!");
        }
      }
    });
    return false;
  });
  $("#edit_user").on('click', function (e) {
    e.preventDefault();

    if ($('.register-form').validate({
      rules: {
        'email': {
          email: true
        }
      }
    }).form()) {} else {
      console.log("edit");
      return false;
    }

    $username = $(this).find('input[name="username"]');
    var url = '/user/edit';
    $.ajax({
      type: "post",
      url: url,
      data: $(this).closest("form.edit-form").serialize() + '&_token=' + $("input[name='_token']").val(),
      dataType: "json",
      success: function success(res) {
        console.log(res);

        if (res.success) {
          toastr["success"]("更新されました", "成功!");
          window.location.reload();
        } else {
          toastr["error"]("失敗した!", "失敗!");
        }
      }
    });
    return false;
  });
  $(".usertype").change(function (e) {
    e.preventDefault();

    if ($(this).val()) {
      var the = $(this);
      swal({
        title: "",
        text: "更新しますか？",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "確認",
        cancelButtonText: "キャンセル",
        closeOnConfirm: true,
        closeOnCancel: true
      }, function (isConfirm) {
        if (isConfirm) {
          $.ajax({
            type: "post",
            url: '/user/change_usertype',
            data: {
              user_type: the.val(),
              user_id: the.attr('user-id'),
              _token: $("input[name='_token']").val()
            },
            dataType: "json",
            success: function success(res) {
              console.log(res);

              if (res.success) {
                toastr["success"]("更新されました", "成功!");
              } else {
                toastr["error"]("失敗した!", "失敗!");
              }
            }
          });
        }
      });
    }

    return false;
  });
  $("#user_table").on('click', '.edit', function (e) {
    e.preventDefault();
    var nRow = $(this).parents('tr');
    var data_id = $(nRow).attr("data-id");
    $.ajax({
      type: "post",
      url: '/user/info',
      data: {
        'user_id': data_id,
        _token: $("input[name='_token']").val()
      },
      dataType: "json",
      success: function success(res) {
        if (res.success) {
          $("#edit_role_modal").find("input[name='user_id']").val(data_id);
          $("#edit_role_modal").find("input[name='email']").val(res.user[0].email);
          $("#edit_role_modal").find("input[name='username']").val(res.user[0].username);
          $("#edit_role_modal").find("select[name='user_type']").val(res.user[0].user_type);
          $("#edit_role_modal").find("input[name='first_name']").val(res.user[0].first_name);
          $("#edit_role_modal").find("input[name='last_name']").val(res.user[0].last_name);
          $("#edit_role_modal").find("input[name='position']").val(res.user[0].position);
          $("#edit_role_modal").find("input[name='phone']").val(res.user[0].phone);
          $("#edit_role_modal").find("input[name='company']").val(res.user[0].company);
        }
      }
    });
  });
  $("#user_table").on('click', '.delete', function (e) {
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
      closeOnConfirm: true,
      closeOnCancel: true
    }, function (isConfirm) {
      if (isConfirm) {
        $.ajax({
          type: "post",
          url: '/user/delete',
          data: {
            'user_id': data_id,
            _token: $("input[name='_token']").val()
          },
          dataType: "json",
          success: function success(res) {
            if (res.success) {
              toastr["success"](res.msg, "成功!");
              window.location.reload();
            } else {
              toastr["error"](res.msg, "失敗!");
            }
          }
        });
      }
    });
  });
});

/***/ }),

/***/ 5:
/*!************************************!*\
  !*** multi ./resources/js/user.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! E:\web\Laravel\Huqvarna\husqvarna-amazonapi\resources\js\user.js */"./resources/js/user.js");


/***/ })

/******/ });