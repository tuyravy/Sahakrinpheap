$(document).ready(function()
{
    $("#DownloadExcel").on("click",function()
    {                      
        var brname=$("#branchname").val();
        var datestart=$("#datestart").val();
       
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
                                                     
                    window.location.href="DownloadactiveBorrower/"+brname+"/"+datestart; 
                
                
            
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