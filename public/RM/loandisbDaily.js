$(document).ready(function()
{
    $("#DownloadExcel").on("click",function()
    {                      
        var brname=$("#branchname").val();
        var datestart=$("#datestart").val();
        var dateend=$("#dateend").val();
        if(brname==''){
                                   
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
                                                   
                    window.location.href="DownloadloanDisbDaily/"+brname+"/"+datestart+"/"+dateend; 
               
            
        }
    });
    
    $("#search").click(function()
    {
       
        var branchname = $.trim($('#branchname').val());
                    // Check if empty of not
                        if (branchname ==''){                        
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