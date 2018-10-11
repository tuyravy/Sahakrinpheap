<style>
    .font13{
        font-size: 14px;
    }
</style>

<div class="row" role="main" style="background-color: white;">
    <div class="clearfix"></div>
    
    <div class="row">
        
        <!--current balance SKP-->
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count" style="font-size:20px"></div>
                <h3  class="font13" style="margin-top: 10px;">Number of loan active in month</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php foreach($datahistory as $row){echo $row->activeloan;}?></span></h1>
            </div>
        </div>
        <!--current balance MMI-->
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon" style="margin-top:5px;"><i class="fa fa-users"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3  class="font13" style="margin-top: 10px;">Number of loan disbursement in month</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php foreach($datahistory as $row){echo $row->disbloan;}?></span></h1>
            </div>
        </div>
        <!--current balance FSS-->
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3  class="font13" style="margin-top: 10px;">Number of loan written-off in month </h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php foreach($datahistory as $row){echo $row->woloan;}?></span></h1>
            </div>
        </div>
        <!--pending cash request-->
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-area-chart"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3 class="font13" style="margin-top: 10px;">Number of loan PAR>90days</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
               
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon" style="margin-top:10px;"><i class="fa fa-credit-card"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3 class="font13" style="margin-top: 10px;">Balance of loan written-off collection-Daily</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php foreach($datahistory as $row){
                        echo number_format($row->WoAmt,0);
                        echo " / ";
                        echo $row->AccCollectWOInmonth;
                    }?>
                </span></h1>
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-users"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3 class="font13" style="margin-top: 10px;">Number of loan closed in month</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;"><?php foreach($datahistory as $row){echo $row->closeloan;}?></span></h1>
            </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon" style="margin-top:10px;"><i class="fa fa-credit-card"></i></div>
                <div class="count" style="font-size: 20px"></div>
                <h3 class="font13" style="margin-top: 10px;">Balance of loan>90days collection-daily</h3>
                <p><a href="javascript:void(0)">&nbsp;</a></p>
                <h1><span style="padding:10px;">0</span></h1>
            </div>
        </div>
        
    </div>
</div>
