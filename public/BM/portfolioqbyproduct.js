$(document).ready(function()
{
    $("#DownloadExcel").on("click",function()
    {                      
        var brname=$("#branchname").val();
        var datestart=$("#datestart").val();
        var dateend=$("#dateend").val();
        var CoName=$("#CoName").val(); 
        var singleBranch=$(".CoNameSingle").val();
        var brcode=$("#brcode").val();
        if(CoName=='' && brname==''){
                                   
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
        else if(CoName==''){
            swal({
                title: "សូមលោកអ្នកជ្រើសរើសឈ្មោះមន្ត្រីឥណទាន!",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-info',                      
                closeOnCancel: false
                });                            
                return false;
        }
        else if(singleBranch=='')
        {
            swal({
                title: "សូមលោកអ្នកជ្រើសរើសឈ្មោះមន្ត្រីឥណទាន!",
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
                if(singleBranch===undefined){                                      
                    window.location.href="DownloadPortfolioQualitybyProductDaily/"+brname+"/"+CoName+"/"+datestart+"/"+dateend; 
                
                }else{
                    window.location.href="DownloadPortfolioQualitybyProductDaily/"+brcode+"/"+singleBranch+"/"+datestart+"/"+dateend;  
                }
            
        }
    });
    $("#branchname").on("change",function(){
        var brcode=$(this).val();
            $.ajax({
                type: 'POST',
                url: 'GetCoName',          
                data:{                   
                brcode:brcode
                },
                success:function(data){                                 
                $("#CoName").html(data);
                }
            });
    });
    var brcode=$("#brcode").val();
    $(".CoNameSingle").on('click',function(){
                var idco=$(this).val();
                if(idco==''){
                    $.ajax({
                        type: 'POST',
                        url: 'GetCoName',    
                        data:{                   
                        brcode:brcode
                        },
                        success:function(data){                                 
                            $(".CoNameSingle").html(data);
                        }
                    });
                }      
                
        
    });
    $("#search").click(function()
    {
       
        var CoName = $.trim($('#CoName').val()); 
        var CoNameSingle = $.trim($('.CoNameSingle').val()); 
       
                    // Check if empty of not
                        if (CoName =='' && CoNameSingle==''){                        
                            swal({
                            title: "សូមលោកអ្នកជ្រើសរើសឈ្មោះមន្ត្រីឥណទាន!",
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