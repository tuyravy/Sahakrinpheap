
            <div class="container">
            <br/>
            <div class="col-sm-12">

                <div class="panel panel-default">

                        <div class="panel-heading">Build Calendar</div>
                        <div class="panel-body">

                        <fieldset class="col-md-4">    	
                                <legend>Actions</legend>

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <p><button class="btn btn-default" type="button" id="setholiday">Set as Holiday</button></p>
                                        <p><button class="btn btn-default" type="button" id="setworkingday">Set as Working Day</button></p>
                                        <p><button class="btn btn-default" type="button" id="setweekend">Set as Weekend</button></p>
                                    </div>
                                </div>

                            </fieldset>		

                            <fieldset class="col-md-7" id="padding">    	
                                <legend>Calendar</legend>

                                <div class="panel panel-default">
                                    <div class="panel-body">
                                            
                                        
                                            <form class="form-inline">
                                            <div class="form-group">
                                                 <div id="workingday">
                                                     <label>Working Day</label>
                                                     <select class="form-control">
                                                          <option value="1">January</option>
                                                          <option value="2">February</option>
                                                          <option value="3">March</option>
                                                          <option value="4">April</option>
                                                          <option value="5">May</option>
                                                          <option value="6">June</option>
                                                          <option value="7">July</option>
                                                          <option value="8">August</option>
                                                          <option value="9">September</option>
                                                          <option value="10">October</option>
                                                          <option value="11">November</option>
                                                          <option value="12">December</option>

                                                     </select>
                                                     <label>To:</label>
                                                    <select class="form-control">
                                                          <option value="1">January</option>
                                                          <option value="2">February</option>
                                                          <option value="3">March</option>
                                                          <option value="4">April</option>
                                                          <option value="5">May</option>
                                                          <option value="6">June</option>
                                                          <option value="7">July</option>
                                                          <option value="8">August</option>
                                                          <option value="9">September</option>
                                                          <option value="10">October</option>
                                                          <option value="11">November</option>
                                                          <option value="12">December</option>

                                                     </select>
                                                    <select class="form-control">
                                                        <?php 

                                                            $year=2017;
                                                            for($year=2017;$year<=date('Y')+10;$year++)
                                                            {
                                                                echo "<option>".$year."</option>";
                                                            }
                                                         ?> 

                                                    </select>
                                                     <button type="button" class="btn btn-success" style="margin-top:3px;">Generate</button>
                                                 </div>  
                                                
                                              </div>
                                             <div id="weekendday">
                                                 <div class="form-group">
                                                     <label for="exampleInputName2">Weekend Day</label>
                                                    <input type="text" name="reportdate" 
                                                    data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control"  placeholder="">  
                                                </div> 
                                             <button type="button" class="btn btn-success" style="margin-top:3px;">Generate</button>
                                                 
                                             </div>
                                             <div id="holiday">
                                                <div class="form-group">
                                                <label for="exampleInputName2">Holiday</label>
                                                <input type="text" name="reportdate" 
                                                data-provide="datepicker" data-date-format="yyyy-mm-dd" class="form-control"  placeholder="">  
                                            
                                                </div> 
                                                <button type="button" class="btn btn-success" style="margin-top:3px;">Generate</button>
                                             </div>   
                                              
                                            </form>
                                           
                                            

                                    </div>
                                </div>

                            </fieldset>
                            <div class="clearfix"></div>
                        </div>

                 </div>

            </div>
            </div>   
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
          <script src="<?php echo base_url();?>public/vendors/jquery/dist/jquery.min.js"></script>  
         <!-- Include Required Prerequisites -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <!-- Include Date Range Picker -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

        <script>
            $(document).ready(function()
            {
               $('#setholiday').click(function(){
                   $('#workingday').hide();
                   $('#weekendday').hide();
                   $('#holiday').show();
               });
               $('#setworkingday').click(function()
                {
                   $('#workingday').show();
                   $('#holiday').hide();
                   $('#weekendday').hide();
               });
                $('#setweekend').click(function()
                {
                   $('#workingday').hide();
                   $('#holiday').hide();
                   $('#weekendday').show();
               }); 
                
            })
        </script>




         <script type="text/javascript">
            $(function() {
                $('input[name="reportdate"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true

                },
               
                function(start, end, label) {
                    var years = moment().diff(start, 'years');
                    //alert("You are " + years + " years old.");
                });
                
            });
         
        </script>

              
  


















<style>
    #padding{margin-left:10px;}
    fieldset 
	{
		border: 1px solid #ddd !important;
		margin: 0;
		xmin-width: 0;
		padding: 10px;       
		position: relative;
		border-radius:4px;
		background-color:#f5f5f5;
		padding-left:10px!important;
	}	
	
		legend
		{
			font-size:14px;
			font-weight:bold;
			margin-bottom: 0px; 
			width: 35%; 
			border: 1px solid #ddd;
			border-radius: 4px; 
			padding: 5px 5px 5px 10px; 
			background-color: #ffffff;
		}
</style>