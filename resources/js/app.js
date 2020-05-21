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
            loadingMessage: 'Loading...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options                 
                // save datatable state(pagination, sort, etc) in cookie.
                "bStateSave": true,                

                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 20, // default record count per page
                "ajax": {
                    "url": "/ajax_dashbaord", // ajax source
                    "dataSrc": function(res){

                        for ( var i=0, ien=res.data.length ; i<ien ; i++ ) {
                            
                            res.data[i] = $.map(res.data[i], function(value, index) {                                            
                                            return [value];
                                          });
                        }                        
                        return res.data;                        
                    }
                },
                "language":{
                    "lengthMenu": "",
                    "zeroRecords": "",
                    "info": "",
                    "infoEmpty": "",
                    "infoFiltered": ""
                },
                createdRow: function (row, data, dataIndex) {                    
                    $(row).attr('data-id', data[0]);                    
                },
                "columnDefs": [ 
                    {
                        "targets":0,
                        "visible":false
                    },
                    {
                        "targets": -1,
                        "data": null,
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
                    } 
                ],
                "ordering": false,
                "order": [
                    [1, "asc"]
                ]// set first column as a default sort by asc
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
            },
            function(isConfirm) {
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