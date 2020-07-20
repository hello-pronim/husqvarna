var FormDropzone = function () {


    return {
        //main function to initiate the module
        init: function () {  

            Dropzone.options.myDropzone = {
                dictDefaultMessage: "",
                acceptedFiles: '.csv,.xls,.xlsx',
                //autoProcessQueue: false,
                maxFiles:1,
                renameFile:"po_csv",
                dictInvalidFileType: "このタイプのファイルはアップロードできません。",
                init: function() {
                    this.on("addedfile", function(file) {
                        // Create the remove button
                        var removeButton = Dropzone.createElement("<a href='javascript:;'' class='btn red btn-sm btn-block'>削除する</a>");
                        
                        // Capture the Dropzone instance as closure.
                        var _this = this;

                        // Listen to the click event
                        removeButton.addEventListener("click", function(e) {
                          // Make sure the button click doesn't submit the form:
                          e.preventDefault();
                          e.stopPropagation();

                          // Remove the file preview.
                          _this.removeFile(file);
                          // If you want to the delete the file on the server as well,
                          // you can do the AJAX request here.
                        });

                        // Add the button to the file preview element.
                        file.previewElement.appendChild(removeButton);
                    });                  
                },
                success:function(res){
                  console.log(res);
                  if(res.status=="success"){
                    var response = JSON.parse(res.xhr.response);
                    if(response.success){
                      toastr["success"](response.msg);  
                    }else{
                      toastr["error"](response.msg);  
                    }
                  }else{
                    toastr["error"]("失敗!")
                  } 
                }      
            }


            $("#dropzone-fileupload").click(function(event){
              console.log("ssss");
              $(this).parent().parent().find("form").submit();
            });
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
   FormDropzone.init();
});