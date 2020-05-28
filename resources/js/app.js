var DatatablesAjax = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: App.isRTL(),
            autoclose: true
        });
    }

    var handleDashboard = function () {

        var table = $("#dashboard");

        if (!$().dataTable) {
            return;
        }

        var grid = new Datatable();

        grid.init({
            src: $("#dashboard"),
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
                    "lengthMenu": "&nbsp;&nbsp; _MENU_",
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
                        "page": "",
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
                        className: 'dt-body-center',
                    },
                    {
                        "targets":2, 
                        className: 'dt-body-center',
                    },
                    {
                        "targets":1,       
                        "orderable": false,                 
                        "render":function(data, type, full, meta){                            
                            return '<i class="fa fa-circle green"></i>';
                        },
                    },
                    {
                        "targets":2,                        
                        "orderable": false,
                        "render":function(data, type, full, meta){                            
                            return '<i class="fa fa-circle red"></i>';
                        },
                    },
                    {
                        "targets": -1,
                        "data": null,
                        "orderable": false,
                        "defaultContent": '<div class="btn-group pull-right">'
                                                +'<button class="btn green btn-xs btn-outline dropdown-toggle" data-toggle="dropdown">操作'
                                                    +'<i class="fa fa-angle-down"></i>'
                                                +'</button>'
                                                +'<ul class="dropdown-menu pull-right">'
                                                    +'<li>'
                                                        +'<a href="javascript:;" class="edit">'
                                                            +'<i class="fa fa-edit"></i>編集</a>'
                                                    +'</li>'
                                                    +'<li>'
                                                        +'<a href="javascript:;" class="delete" >'
                                                            +'<i class="fa fa-remove"></i> 削除 </a>'
                                                    +'</li>'                                                        
                                                +'</ul>'
                                            +'</div>'
                    },
                    {
                        "targets":-3,                        
                        "render":function(data){
                            return "¥" + data;
                        },
                        className: 'dt-body-right',                        
                    },
                ],
                "ordering": true,
                "order": [
                    [3, "asc"]
                ]// set first column as a default sort by asc
            }
        });

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

    }

    return {

        //main function to initiate the module
        init: function () {            
            handleDashboard();            
        }

    };

}();

jQuery(document).ready(function() {        
    DatatablesAjax.init();
});