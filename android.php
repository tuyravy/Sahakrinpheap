<?php 
    $db_name="spmficom_cbs_reporting";
    $mysql_username="spmficom_cbs";
    $mysql_password="St4N+!%pZoL%";
    $server_name="45.40.138.90";
    $conn=mysqli_connect($server_name,$mysql_username,$mysql_password,$db_name);
    $user='tuyravy';
    $pass='skp@008';
    $mysql="select * from users where username='".$user."' and password='".$pass."'";
    $result=mysqli_query($conn,$mysql);
   
    if(mysqli_num_rows($result)>0)
    {
        echo "Connection success";
    }else
    {
        echo "Connection not success";
        
    }
?>