$(document).ready(function()
{
    $("#DownloadExcel").on("click",function()
    {                      
        var systemid=$("#systemid").val();
        var datestart=$("#datestart").val();
        var dateend=$("#dateend").val();
       
        if(systemid==''){
                                   
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
            window.location.href="DownloadPortfolioQualitybyProductDaily/"+systemid+"/"+datestart+"/"+dateend; 
                
        }
    });
    
    $("#search").click(function()
    {
       
        var systemid = $.trim($('#systemid').val()); 
     
                    // Check if empty of not
                        if (systemid ==''){                        
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
                    
        });
});