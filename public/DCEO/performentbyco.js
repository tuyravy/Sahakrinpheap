$(document).ready(function()
{
    $("#DownloadExcel").on("click",function()
    {                      
        var systemid=$("#systemid").val();
        var datestart=$("#datestart").val();
        var dateend=$("#dateend").val();
        var brcode=$("#branchname").val();
        if(systemid=='' && brcode==''){
                                   
                swal({
                title: "សូមជ្រើសរើសយក All ប្រសិនបើលោកអ្នកចង់ទាយយក File Excel",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-info',                      
                closeOnCancel: false
                });                            
                return false;
           
        }      
       
        else
        {                                
            window.location.href="Downloadperformentbyco/"+systemid+"/"+brcode+"/"+datestart+"/"+dateend;  
        }
    });

    $("#DownloadExcel_by_Co").on("click",function(){
                                
            window.location.href="Download_DESB_performentbyco";  
        
    });
    $("#systemid").on("change",function(){
        var sid=$(this).val();
            $.ajax({
                type: 'POST',
                url: 'GetBrName',          
                data:{                   
                sid:sid
                },
                success:function(data){                                 
                $("#branchname").html(data);
                }
            });
    });
    $("#search").click(function()
    {
        var systemid = $.trim($('#systemid').val()); 
        var brcode=$("#branchname").val();
       
                    // Check if empty of not
                        if (systemid=="" && brcode==""){                        
                            swal({
                            title: "សូមលោកអ្នកជ្រើសរើសឈ្មោះប្រធានតំបន់!",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: 'btn-info',                      
                            closeOnCancel: false
                            });                            
                            return false;
                        }
                        if (brcode==""){                        
                            swal({
                            title: "សូមលោកអ្នកជ្រើសរើសឈ្មោះសាខា!",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: 'btn-info',                      
                            closeOnCancel: false
                            });                            
                            return false;
                        }
                       
                       
        });
});