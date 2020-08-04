var DatatablesAjax = function () {

    var handleAPI = function () {

        if (!$().dataTable) {
            return;
        }

        var grid = new Datatable();

        grid.init({
            src: $("#apis"),
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
                "responsive" : true,
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
                "pageLength": 50, // default record count per page
                "ajax": {
                    "url": "/ajax_get_apis", // ajax source
                },
                "language":{
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
                    "search":"検索:"
                },
                createdRow: function (row, data, dataIndex) {                    
                    $(row).attr('api-id', data[0]);                    
                },               
                "columnDefs": [                    
                    {
                        "targets":0,       
                        visible:false, 
                    },                 
                    {
                        "targets":1,       
                        "orderable": false,                 
                        "render":function(data, type, full, meta){      
                            return '<span class="input-group-btn">'+
                                        '<button class="btn '+ (data=="on"?"green":data=="check"?"yellow":data=="down"?"red":"") +' btn-sm" type="button">'+data.toUpperCase()+'</button>'+
                                    '</span>';
                        },
                        className: 'dt-body-center',
                    },                   
                    {
                        "targets":2,       
                        "orderable": false,                 
                        "render":function(data, type, full, meta){        
                            return '<span class="input-group-btn">'+
                                        '<button class="btn '+(data==1?"blue":"")+' btn-sm btn-api-alert" alert="'+data+'" type="button">'+(data==1?"ON":"OFF")+'</button>'+
                                    '</span>';
                        },
                        className: 'dt-body-center',
                    },             
                    {
                        "targets":3,   
                        "orderable": false,                  
                        "render":function(data, type, full, meta){ 
                            var select = "";
                            select += '<select class="form-control input-small input-sm input-inline mr-10 select-api-via">';
                            select += '<option value="sms"'+(data=="sms"? 'selected':'')+'>SMS</option>';
                            select += '<option value="email"'+(data=="email"? 'selected':'')+'>EML</option>';
                            select += '<option value="tel"'+(data=="tel"? 'selected':'')+'>TEL</option>';
                            select += '</select>';
                            return select;
                        },
                    },   
                    {
                        "targets":4, 
                        "orderable": false,                      
                        "render":function(data, type, full, meta){
                            var list="<div class='api-to-list-container'>";
                            list+="<ul class='api-to-list'>";
                            var len = data.length;
                            for(var i=0; i<len; i++){
                                list+="<li>"+data[i].receiver+"</li>";
                            }
                            list+="</ul>";
                            list+="<i class='fa fa-plus-circle'></i>";
                            list+="</div>";
                            return list;
                        },
                    },
                    {
                        "targets":-1,                     
                        "render":function(data, type, full, meta){
                            return data;
                        },
                    },
                ],
                "ordering": false,
            }
        });
        var table = grid.getTable();

        table.on('click', '.api-to-list-container i', function (e) {
            e.preventDefault();
            if(!$(this).parent().find('.api-to-list input').length)
                $(this).parent().find('.api-to-list').append('<li><div class="flex-row align-items-center"><input class="form-control input-sm input-small"><span class="input-group-btn"><button class="btn blue btn-sm btn-save" type="button">保存</button></span></div></li>');
        });
        table.on('click', '.api-to-list-container button', function (e) {
            e.preventDefault();
            var text = $(this).parent().parent().find('input').val();
            $(this).parent().parent().parent().replaceWith('<li>'+text+'</li>');
        });
        table.on('click', '.btn-api-alert', function (e) {
            e.preventDefault();
            var btn = $(this);
            var alert = $(this).attr('alert');
            var api_id = $(this).closest('tr').attr('api-id');
            $.ajax({
                url: '/ajax_api_alert_update',
                data: {alert: 1-alert, api_id: api_id},
                type: 'post',
                dataType: 'json',
                success: function(res){
                    if(res.success==true){
                        if($(btn).hasClass('blue')){
                            $(btn).removeClass('blue');
                            $(btn).html("OFF");
                            $(btn).attr('alert', 0);
                        }else{
                            $(btn).addClass('blue');
                            $(btn).html("ON");
                            $(btn).attr('alert', 1);
                        }
                        toastr["success"](res.msg, "成功!")
                    }else{
                        toastr["error"](res.msg, "失敗!")
                    }
                }
            })
        });
    }

    return {

        //main function to initiate the module
        init: function () {    
            handleAPI();
        }

    };

}();

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