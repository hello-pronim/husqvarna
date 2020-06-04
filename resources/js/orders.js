var DatatablesAjax = function () {

    var handleWarehouse = function () {

        if (!$().dataTable) {
            return;
        }

        var grid = new Datatable();

        grid.init({
            src: $("#order_warehouse"),
            onSuccess: function (grid, response) {
                // grid:        grid object
                // response:    json object of server side ajax response
                // execute some code after table records loaded
            },
            onError: function (grid) {                
                // execute some code on network or other general error  
            },
            onDataLoad: function(grid) {                
                // execute some code on ajax data load
            },
            loadingMessage: '読み込んでいます...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options                 
                // save datatable state(pagination, sort, etc) in cookie.
                "dom": "<'row'<'col-md-4 col-sm-12'pli><'col-md-4 col-sm-12'<'data-picker'>><'col-md-4 col-sm-12'f>r>t<'row'<'col-md-4 col-sm-12'pli><'col-md-4 col-sm-12'><'col-md-4 col-sm-12'>>", 
                "bStateSave": true,  
                "bFilter": true,
                "bInfo": true,
                //"bProcessing" : true,
                "bSortable": false,
                "bPaginate" : true,             
                // read the custom filters from saved state and populate the filter inputs
                 "fnStateSaveParams":    function ( oSettings, sValue ) {                  
                },

                // read the custom filters from saved state and populate the filter inputs
                "fnStateLoadParams" : function ( oSettings, oData ) {                   
                },
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 20, // default record count per page
                "ajax": {
                    "url": "/ajax_dashbaord", // ajax source
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
                "language":{
                    "lengthMenu": "&nbsp;<span class='pageLength'>表示数:</span>&nbsp; _MENU_",
                    "zeroRecords": "該当する記録が見つかりません。",
                    "info": "",
                    "infoEmpty": "表示するレコードが見つかりませんでした。",
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
                    "search":"検索:"
                },
                createdRow: function (row, data, dataIndex) {                    
                    $(row).attr('data-id', data[0]);                    
                },
                "columnDefs": [ 
                    {
                        "targets":0, 
                        visible:false,      
                    },                    
                    {
                        "targets":1,       
                        // "orderable": false,                 
                        // "render":function(data, type, full, meta){                            
                        //     return '<i class="fa fa-circle green"></i>';
                        // },
                        // className: 'dt-body-center',
                        visible:false
                    },
                    {
                        "targets":2,                        
                        "orderable": false,
                        "render":function(data, type, full, meta){                            
                            return '<i class="fa fa-circle red"></i>';
                        },
                        className: 'dt-body-center',
                    },                   
                    {
                        "targets":-1,
                        "render":function(data, type, full, meta){                            
                            if(data==null) data='';
                            var tracking_no_input ='<div class="input-group tracking_box" order-id="'+full[0]+'">' +
                                    '<input type="text" value="'+data+'" class="form-control input-sm tracking_no" name="tracking_no" placeholder="0000-0000-0000">'+
                                    '<span class="input-group-btn">'+
                                        '<button class="btn blue btn-sm" txt="change" type="button">保存</button>'+
                                    '</span>'+
                                '</div>';                            

                            return tracking_no_input;
                        },
                        className: 'dt-body-center',
                    },
                    {
                        "targets":-2,    
                        visible:false,                    
                        // "render":function(data){
                        //     return "¥" + data;
                        // },
                        // className: 'dt-body-right',
                    },
                ],
                "ordering": true,
                "order": [
                    [3, "asc"]
                ]// set first column as a default sort by asc
            }
        });

        var table = grid.getTable();

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr');
            var data_id = $(nRow).attr("data-id") ;

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
            },
            function(isConfirm) {
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
            'class':'form-control input-xs input-sm input-inline ml-10',
            'type': 'text',
            'name': 'po_date_range',
            'value': init_date[0] + ' - ' + init_date[1],            
            'disabled':true

        }).daterangepicker({
                opens: 'left',
                locale: {
                  format: 'YYYY/MM/DD',
                  applyLabel: "適用",
                  cancelLabel: "キャンセル",
                  daysOfWeek: [
                    "日",
                    "月",
                    "火",
                    "水",
                    "木",
                    "金",
                    "土"
                  ],
                  monthNames: [
                      "1月",
                      "2月",
                      "3月",
                      "4月",
                      "5月",
                      "6月",
                      "7月",
                      "8月",
                      "9月",
                      "10月",
                      "11月",
                      "12月"
                  ],
                }
            }, function(start, end, label) {
                start_date_val = start.format('YYYY-MM-DD');
                end_date_val = end.format('YYYY-MM-DD');
                console.log(start_date_val);

                grid.setAjaxParam("start_date_val", start.format('YYYY-MM-DD'));
                grid.setAjaxParam("end_date_val", end.format('YYYY-MM-DD')); 
                grid.ajax_reload();               
            });

        var date_slider = $("<input>", {
                    "id" :"po_on_off",
                    "type":"checkbox",
                    "checked" : true,
                    'data-toggle':"toggle",
                    'data-on':"期間",
                    'data-off':"全部",
                    'data-onstyle':"primary",
                    'data-offstyle':"danger",
                    change: function(e){
                        if($(this).prop("checked")){
                            grid.setAjaxParam("start_date_val", '');
                            grid.setAjaxParam("end_date_val", ''); 
                            datepicker.prop('disabled', true);
                        }else{
                            grid.setAjaxParam("start_date_val", start_date_val);
                            grid.setAjaxParam("end_date_val", end_date_val); 
                            datepicker.prop('disabled', false);
                        }
                        grid.ajax_reload();
                    }
                });        

        


        $(".data-picker").append(date_slider).append(datepicker);

        date_slider.bootstrapToggle();


        table.on('click', '.tracking_box button', function(e) {
            var tracking_box = $(this).parent().parent();
            var the = $(this);
            // if( $(this).attr('txt') == "change" ){
            //     $(this).attr('txt', "confirm");
            //     $(this).text("確認");
            //     $(this).removeClass('blue');
            //     $(this).addClass('green');

            //     tracking_box.find("input").prop("readonly", false);
            // }

            if($(this).attr('txt') == "change"){
                $.ajax({
                    type:"post",
                    url:'/ajax_tracking_update',
                    data:{order_id: tracking_box.attr('order-id'), tracking_no: tracking_box.find("input").val()},
                    success: function(res){
                        if(res.success==true){
                            toastr["success"](res.msg, "成功!")
                        }else{
                            toastr["error"](res.msg, "失敗!")
                        }

                        // the.attr('txt', "change");
                        // the.text("保存");
                        // the.removeClass('green');
                        // the.addClass('blue');
                        // tracking_box.find("input").prop("readonly", true);
                    }
                });
            }
        });
        
    }

    return {

        //main function to initiate the module
        init: function () {               
            handleWarehouse();
        }

    };

}();

var init_daterange = function(){
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();

    var from = d.getFullYear() + '/' +
    (month<10 ? '0' : '') + month + '/' +
    '01';

    var to = d.getFullYear() + '/' +
    (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + day;

    return [from, to];
}

jQuery(document).ready(function() {   

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
    }     

    DatatablesAjax.init();
});