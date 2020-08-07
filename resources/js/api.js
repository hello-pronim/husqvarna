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
                            var cell = "<span class='cs-checkbox flex-row align-items-center'><input type='checkbox' name='alert_email' value='1' "+(data==1?'checked':'')+"><label>EML</label></span>";
                            var list="<div class='api-to-list-container'>";
                            list+="<ul class='api-to-list' alert-type='email' api-id='"+full[0]+"'>";
                            var emails = full[5];
                            var len = emails.length;
                            for(var i=0; i<len; i++){
                                if(emails[i].type=="email")
                                    list+="<li receiver-id='"+emails[i].id+"'><i class='fa fa-minus-circle btn-remove-receiver'></i><span>"+emails[i].receiver+"</span><i class='fa fa-pencil btn-edit-receiver'></i></li>";
                            }
                            list+="<li><i class='fa fa-plus-circle btn-add-receiver-input'></i></li>";
                            list+="</ul>";
                            list+="</div>";
                            cell+=list;
                            return cell;
                        },
                    },              
                    {
                        "targets":3,   
                        "orderable": false,                  
                        "render":function(data, type, full, meta){ 
                            var cell = "<span class='cs-checkbox flex-row align-items-center'><input type='checkbox' name='alert_tel' value='1' "+(data==1?'checked':'')+"><label>TEL</label></span>";
                            var list="<div class='api-to-list-container'>";
                            list+="<ul class='api-to-list' alert-type='tel' api-id='"+full[0]+"'>";
                            var nums = full[5];
                            var len = nums.length;
                            for(var i=0; i<len; i++){
                                if(nums[i].type=="tel")
                                    list+="<li receiver-id='"+nums[i].id+"'><i class='fa fa-minus-circle btn-remove-receiver'></i><span>"+nums[i].receiver+"</span><i class='fa fa-pencil btn-edit-receiver'></i></li>";
                            }
                            list+="<li><i class='fa fa-plus-circle btn-add-receiver-input'></i></li>";
                            list+="</ul>";
                            list+="</div>";
                            cell+=list;
                            return cell;
                        },
                    },              
                    {
                        "targets":4,   
                        "orderable": false,                  
                        "render":function(data, type, full, meta){ 
                            var cell = "<span class='cs-checkbox flex-row align-items-center'><input type='checkbox' name='alert_sms' value='1' "+(data==1?'checked':'')+"><label>SMS</label></span>";
                            var list="<div class='api-to-list-container'>";
                            list+="<ul class='api-to-list' alert-type='sms' api-id='"+full[0]+"'>";
                            var nums = full[5];
                            var len = nums.length;
                            for(var i=0; i<len; i++){
                                if(nums[i].type=="sms")
                                    list+="<li receiver-id='"+nums[i].id+"'><i class='fa fa-minus-circle btn-remove-receiver'></i><span>"+nums[i].receiver+"</span><i class='fa fa-pencil btn-edit-receiver'></i></li>";
                            }
                            list+="<li><i class='fa fa-plus-circle btn-add-receiver-input'></i></li>";
                            list+="</ul>";
                            list+="</div>";
                            cell+=list;
                            return cell;
                        },
                    },  
                    {
                        "targets":5,   
                        visible: false
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
        table.on('change', 'input[type="checkbox"]', function (e) {
            e.preventDefault();
            var api_id = $(this).closest('tr').attr('api-id');
            var alert_type = $(this).attr('name');
            var alert = $(this).prop('checked');
            $.ajax({
                url: '/ajax_api_alert_type_update',
                data: {api_id: api_id, alert_type: alert_type, alert: alert?1:0},
                type: 'post',
                dataType: 'json',
                success: function(res){
                    if(res.success==true){
                        toastr["success"](res.msg, "成功!");
                    }else{
                        toastr["error"](res.msg, "失敗!");
                    }
                }
            });
        });
        table.on('click', '.api-to-list-container .btn-add-receiver-input', function (e) {
            e.preventDefault();
            var api_id = $(this).closest('tr').attr('api-id');
            if(!$(this).parent().parent().find('input').length)
                $('<li><i class="fa fa-minus-circle btn-remove-receiver"></i><div class="flex-row align-items-center"><input class="form-control input-sm input-small input-receiver"><span class="input-group-btn"><button class="btn blue btn-sm btn-add-receiver" type="button" api-id="'+api_id+'">保存</button></span></div></li>').insertBefore($(this).parent());
        });
        table.on('click', '.btn-add-receiver', function(e){
            e.preventDefault();
            var btn = $(this);
            var api_id = $(this).attr('api-id');
            var receiver = $(this).parent().parent().find('.input-receiver').val();
            var receiver_id = $(this).parent().parent().parent().attr('receiver-id'); 
            var alert_type = $(this).parent().parent().parent().parent().attr('alert-type');
            $.ajax({
                url: '/ajax_api_receiver_add',
                data: {receiver_id: receiver_id?receiver_id:0, receiver: receiver, alert_type: alert_type, api_id: api_id},
                type: 'post',
                dataType: 'json',
                success: function(res){
                    console.log(res);
                    if(res.success==true){
                        $(btn).closest('li').replaceWith('<li receiver-id="'+res.receiver_id+'"><i class="fa fa-minus-circle btn-remove-receiver"></i><span>'+receiver+'</span><i class="fa fa-pencil btn-edit-receiver"></i></li>');
                        toastr["success"](res.msg, "成功!");
                    }else{
                        toastr["error"](res.msg, "失敗!");
                    }
                }
            });
        });
        table.on('click', '.api-to-list-container .btn-edit-receiver', function (e) {
            e.preventDefault();
            var btn = $(this);
            var receiver = $(this).parent().find('span').html();
            var api_id = $(this).closest('tr').attr('api-id');
            var receiver_id = $(this).parent().attr('receiver-id');
            $(btn).parent().replaceWith('<li receiver-id="'+receiver_id+'"><i class="fa fa-minus-circle btn-remove-receiver"></i><div class="flex-row align-items-center"><input class="form-control input-sm input-small input-receiver" value="'+receiver+'"><span class="input-group-btn"><button class="btn blue btn-sm btn-add-receiver" type="button" api-id="'+api_id+'">保存</button></span></div></li>')
        });
        table.on('click', '.api-to-list-container .btn-remove-receiver', function (e) {
            e.preventDefault();
            var receiver = $(this).parent();
            var api_id = $(this).closest('tr').attr('api-id');
            var receiver_id = $(this).parent().attr('receiver-id');
            if(receiver_id){
                $.ajax({
                    url: '/ajax_api_receiver_delete',
                    data: {api_id: api_id, receiver_id: receiver_id},
                    type: 'post',
                    dataType: 'json',
                    success: function(res){
                        if(res.success==true){
                            $(receiver).remove();
                            toastr["success"](res.msg, "成功!");
                        }else{
                            toastr["error"](res.msg, "失敗!");
                        }
                    }
                });
            }else{
                $(receiver).remove();
            }
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
                            $(btn).addClass('red');
                            $(btn).html("OFF");
                            $(btn).attr('alert', 0);
                        }else{
                            $(btn).addClass('blue');
                            $(btn).removeClass('red');
                            $(btn).html("ON");
                            $(btn).attr('alert', 1);
                        }
                        toastr["success"](res.msg, "成功!");
                    }else{
                        toastr["error"](res.msg, "失敗!");
                    }
                }
            });
        });
        table.on('change', '.select-api-via', function(e){
            e.preventDefault();
            var select = $(this);
            var via = $(this).val();
            var api_id = $(this).closest('tr').attr('api-id');
            $.ajax({
                url: '/ajax_api_via_update',
                data: {via: via, api_id: api_id},
                type: 'post',
                dataType: 'json',
                success: function(res){
                    if(res.success==true){
                        toastr["success"](res.msg, "成功!");
                    }else{
                        toastr["error"](res.msg, "失敗!");
                    }
                }
            });
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