<!DOCTYPE html>
<html lang="en">
<?php
require 'core/init.php';

$user = new User();




if(true) {
	?>
<div>  <!--HEADDER-->
 	<div style = "box-sizing:border-box" width = 50%>
     	<img src = "hn2sdn_2.png" alt= "Team Logo"  style = "padding-left:85%"  height =150px topmargen = 3px />   
    </div>
    <div style = "box-sizing:border-box" width = 50%>
    	<ul>
			<a href="logout.php">Log out</a>&nbsp&nbsp&nbsp<a href="changepassword.php">Change password</a>&nbsp&nbsp&nbsp<a href="update.php">Update details</a>
    	</ul>
    </div>
</div> <!--HEADDER ending-->
<head> <!--HEAD-->
    <title> Home network solutions using SDN </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   
	<script>
		var NewRules = [];
		var num = 0;
	</script>	
		<script language = "java">
		function StoreData(){
			conn = DriverManager.getConnection("jdbc:mysql://localhost/macRulesSchema","root", "");
		}
		</script>
	<script>
		/*
		*	Changes display between Network and Rules tabs
		*
		*/
		function switching(Track){
				
                switch(Track){
                    case 0:
                            document.getElementById('settings').style.display='none';
                            document.getElementById('home').style.display='inline';
                            break;
                    case 1:
                            document.getElementById('settings').style.display='inline';
                            document.getElementById('home').style.display='none';
                            break;
                    case defult:
                            break;
                }
        }
		/*
		* No current Use
		*/
        function clearFlows() {
            if(window.XMLHttpRequest){
                xmlHttp = new XMLHttpRequest();
            }else{
                xmlHttp = new ActiveXObjec("Microsoft.XML");
            }
            xmlHttp.onreadystatechange=function(){
                if(xmlHttp.readyState==4&&xmlHttp.status==200){
                }
            }
            xmlHttp.open("GET","delflows.php",true);
            xmlHttp.send();
		}
		
		/*
		*	Passes user input data to table for compleation
		*/
		function Pass(form){
    		var isin = false;
    		
            var name = document.getElementById('usr').options[document.getElementById('usr').selectedIndex].text; //usr id
            var block  = document.getElementById('block').options[document.getElementById('block').selectedIndex].text;
            var DL  = document.getElementById('DL').options[document.getElementById('DL').selectedIndex].text;
            var dl_unit  = document.getElementById('dl_unit').options[document.getElementById('dl_unit').selectedIndex].text;
            var st = document.getElementById('st').options[document.getElementById('st').selectedIndex].text;
            var st_ampm = document.getElementById('st_ampm').options[document.getElementById('st_ampm').selectedIndex].text;
            var endt = document.getElementById('endt').options[document.getElementById('endt').selectedIndex].text;
            var endt_ampm = document.getElementById('endt_ampm').options[document.getElementById('endt_ampm').selectedIndex].text;
            var speed = document.getElementById('speed').options[document.getElementById('speed').selectedIndex].text;
            var beg = st.split(':');
            var end = endt.split(':');
            if(st==endt&&st_ampm==endt_ampm&&st!='No Limit'){
            	alert('Start time and end time can not be the same');
            	return;
            }else if(endt_ampm=='AM'&&st_ampm=='PM'){
            	alert('Start and Stop times are limited to the same day');
            	return;
            }else if (st_ampm==endt_ampm&&beg[0]>end[0]){
            	alert('End time must be after Start time');
            	return;
            }else if (st=='No Limit'&&endt!='No Limit'||endt=='No Limit'&&st!='No Limit'){
            	alert("If you would like to have no time limit, Please select both start and stop times to be 'No Limit'")	
            }else{
    		//format for info = [name, block, start_time, AM/PM, stop_time, AM/PM, speed]
    			if(num == 0){
    				NewRules[num] = Array(name,block,DL,dl_unit,st,st_ampm,endt,endt_ampm,speed);
            		num++;
            		var out = "<tr><td>"+NewRules[0][0]+"</td><td>"+NewRules[0][1]+"</td><td>"+NewRules[0][2]+"</td><td>"+NewRules[0][3]+"</td><td>"+NewRules[0][4]+"</td><td>"+NewRules[0][5]+"</td><td>"+NewRules[0][6]+"</td><td>"+NewRules[0][7]+"</td><td>"+NewRules[0][8]+"</td>";
    				document.getElementById('NewRules').innerHTML=out;
    			}else{
    				for(var i = 0;i<num;i++){
    					if (name == NewRules[i][0]){
    						NewRules[i] = Array(name,block,DL,dl_unit,st,st_ampm,endt,endt_ampm,speed);
    						isin = true;
    					}
    				}
    				if(isin){
    					var out = "<tr><td>"+NewRules[0][0]+"</td><td>"+NewRules[0][1]+"</td><td>"+NewRules[0][2]+"</td><td>"+NewRules[0][3]+"</td><td>"+NewRules[0][4]+"</td><td>"+NewRules[0][5]+"</td><td>"+NewRules[0][6]+"</td><td>"+NewRules[0][7]+"</td><td>"+NewRules[0][8]+"</td>";
    					for(var i=1;i<num;i++){
    						out = out.concat(" ","<tr><td>"+NewRules[i][0]+"</td><td>"+NewRules[i][1]+"</td><td>"+NewRules[i][2]+"</td><td>"+NewRules[i][3]+"</td><td>"+NewRules[i][4]+"</td><td>"+NewRules[i][5]+"</td><td>"+NewRules[i][6]+"</td><td>"+NewRules[i][7]+"</td><td>"+NewRules[i][8]+"</td>");
    					}
    					document.getElementById('NewRules').innerHTML=out;
    				}else{
    					NewRules[num] = Array(name,block,DL,dl_unit,st,st_ampm,endt,endt_ampm,speed);
            			num++;
            			var out = "<tr><td>"+NewRules[0][0]+"</td><td>"+NewRules[0][1]+"</td><td>"+NewRules[0][2]+"</td><td>"+NewRules[0][3]+"</td><td>"+NewRules[0][4]+"</td><td>"+NewRules[0][5]+"</td><td>"+NewRules[0][6]+"</td><td>"+NewRules[0][7]+"</td><td>"+NewRules[0][8]+"</td>";
    					for(var i=1;i<num;i++){
    						out = out.concat(" ","<tr><td>"+NewRules[i][0]+"</td><td>"+NewRules[i][1]+"</td><td>"+NewRules[i][2]+"</td><td>"+NewRules[i][3]+"</td><td>"+NewRules[i][4]+"</td><td>"+NewRules[i][5]+"</td><td>"+NewRules[i][6]+"</td><td>"+NewRules[i][7]+"</td><td>"+NewRules[i][8]+"</td>");
    					}
    					document.getElementById('NewRules').innerHTML=out;
    				}
    			}
			}
		}
		/*
		*	Stores new values into database
		*/
		function StoreNew() {


// JACQUIE
    		if(num == 0){
        		alert('Please enter changes first');
        		return;
    		}
    		if (window.XMLHttpRequest){  				// code for IE7+, Firefox, Chrome, Opera, Safari
        		xmlhttp=new XMLHttpRequest();
    		}else{        						       // code for IE6, IE5
        		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    		}
    		xmlhttp.onreadystatechange=function(){
        		if (xmlhttp.readyState==4 && xmlhttp.status==200){
            		alert('Your Network Rules have been Updated!');
                    window.location.reload(true); // Changed postion from           		
        		}
    		}
    		xmlhttp.open("GET","store.php?Update[]="+NewRules,true);
            xmlhttp.send();
            clearFlows();    
        

// JACQUIE
    	}
   </script> <!--JS funcations END HERE-->

</head> <!--HEAD ENDS HERE-->

<body>
	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
              
            </div><!--navebar headder ENDS HERE --> 
		</nav><!--navbar-static-top ENDS HERE--> 
		<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="hn2sdn_2.png"></i>&nbsp;Home Network</h1>
                </div><!-- col-lg-12 ENDS HERE -->
            </div>
            <div class="col-lg-12" Name = "sub-col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <ul class="nav nav-tabs"><!-- MAIN Nav tabs -->
                            <li class="active" ><a style="color:red" data-toggle="tab" onclick="switching(0)" >Home</a>
                            </li>
							<li  ><a data-toggle="tab" onclick="switching(1)">Network Rules management</a>
                            </li>                   
                        </ul>
                    </div><!--Pannel ENDS HERE-->
                    <div class= "pannel">    
                        <div class="tab-content"><!-- Tab panes -->
                            <div class="tab-pane fade in active" id="home" >
                                <div class="row">
									<div class="col-lg-4.5">
										<div class="panel panel-default">
                        					<div class="panel-heading">
                            					<i class="fa fa-globe"></i> <b>Current Network Settings</b>
											</div><!--panel-heading ENDS HERE-->
											<div class="panel-body"><!--Network Currnet State Table div-->
                            					<div class="table-responsive">
                                					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                   						<thead>
                                       					<tr>
                                           					<th>Device Name</th>
                                           					<th>MAC Address</th>
                                           					<th>Access to Internet</th>
                                           					<th>Downloading Limit</th>
                                           					<th></th>
                                           					<th>Access Start Time</th>
                                           					<th>Accesss End Time</th>
                                           					<th>Speed of Access</th>
                                           					<th></th>
                                       					</tr>
                                   					</thead>
                                   					<tbody>
														<?php
    													/*
    													 *Creating an connection to the MacRulesSchema Database to retrive users 
  	 													 *current setting and display on GUI
   														 */
    														/******** Data arrays for Progress BAR********/
    														$usr = array();
    														$used = array();
    														$total = array();
    														/*************************************/
    														$pullData = DB::getInstance()->query("SELECT * FROM macRulesTable");
    														foreach($pullData->results() as $pullData){
    																				/******** Data for Progress BAR********/
        														$usr[]=$pullData->terminal_name;
        														$used[]=$pullData->current_user_usage;
        														$total[]=$pullData->total_data;
        													/*************************************/
        														echo'<tr>';
       															echo '<td>'.$pullData->terminal_name.'</td>';
       															echo '<td>'.$pullData->mac.'</td>';
   																if($pullData->block == 0){
       																echo'<td>Granted</td>';
    															}else{
            														echo'<td>Denied</td>';
        														}
        														if($pullData->user_total==$pullData->total_data){
            														echo"<td>No Limit</td>";
            														echo'<td> </td>';
        														}elseif($pullData->user_total>1000000000){
            														echo '<td>'.($pullData->user_total/1000000000).'</td>';
            														echo'<td>GB</td>';
        														}else{
            														echo '<td>'.($pullData->user_total/1000000).'</td>';
            														echo'<td>MB</td>';
        														}
        														/************FOR CONVERSION*************/
        														$hour = explode(":",$pullData->start_time);
        														/***************************************/
        														if($pullData->start_time=='00:00:00'){
            														echo'<td>No Limit</td>';
        														}elseif($hour[0]>12){    
            														echo'<td>'.($hour[0]-12).":".$hour[1].":".$hour[2].' PM</td>';      
        														}else{
            														echo '<td>'.$pullData->start_time.' AM</td>';
        														}
        														/***********FOR CONVERSION*************/
         														$hour = explode(":",$pullData->stop_time);
         														/***************************************/
         														if($pullData->start_time=='00:00:00'){
             														echo'<td>No Limit</td>';       
         														}elseif($hour[0]>12){
             														echo'<td>'.($hour[0]-12).":".$hour[1].":".$hour[2].' PM</td>';   
         														}else{
             														echo '<td>'.$pullData->stop_time.' AM</td>';      
         														}
       															if($pullData->bw_limit==$pullData->total_bw){
            														echo'<td>No Limit</td>';  
             														echo'<td> </td>'; 
         														}elseif($pullData->bw_limit==($pullData->total_bw/2)){ //slow = 10%, med = 25%, fast = 50%
         															echo'<td>Fast</td>';  
     															}elseif($pullData->bw_limit<($pullData->total_bw/4)){
        															echo'<td>Slow</td>';
    															}else{
        															echo'<td>Medium</td>';
    															}
															}
														?>
													</tbody>
                               						</table>
                           						</div><!-- /.table-responsive -->
                        						<h1>Total Current Usage</h1>
                             					<div class="progress">
                             					<?php
                                                            $color = array('#90EE90','#FFB6C1','#87CEFA','#778899','#F08080','#E0FFFF','#20B2AA','#FFA07A');
                                                            $temp = array('"progress-bar progress-bar-success"','"progress-bar progress-bar-warning"','"progress-bar progress-bar-danger"');
                                                    $m=0;       
                                                    for ($i=0;$i<count($usr);$i++){
                                                        if($m>2){
                                                            $m=0;
                                                        }        
                               							$percent = ($used[$i]/$total[$i])*100;
                                                        echo'<div class='.$temp[$m].' role="progressbar" area-valuenow = "'.$percent.'"  style="width:'.$percent.'%">'.$usr[$i].' '.round($percent,2).'%</div>';
                                                        $m++;
                               						}
                           						?>
                           						</div><!--Progress bar div ENDS HERE-->
                           					</div><!---Pannel body ENDS HERE-->	                         	 					
                        				</div><!--Pannel Default ENDS HERE-->
                        			</div><!--col-lg-4.5 ENDS HERE-->
                        		</div><!--Row ENDS HERE-->
							</div><!--Tab HOME ENDS HERE-->

							<div class="tab-pane fade in active" id="settings" style = 'display:none'>                               
    							<div class="row">
        							<div class="col-lg-4.5">
            							<div class="panel panel-default">
                							<div class="panel-heading">
                    							<i class="fa fa-user"></i> <b>Rule Assingment</b>
                							</div><!-- /.panel-heading -->
                    						<div class="panel-body">                            
                        						<div class="form-group">
                        							<div class="col-sm-2"><!--USER LIST-->   
                            							<label>Users</label><p>Select Device to alter rules</p>
                            							<select multiple="" class="form-control" id = "usr">
                                							<?php
                                								$get_users = DB::getInstance()->query("SELECT mac, terminal_name FROM macRulesTable");
                                								foreach($get_users->results() as $get_users){
                                								    echo '<option name = '.$get_users->mac.' >'.$get_users->terminal_name.'</option>';
                                								}
                                							?>
                            							</select >
                        							</div><!--END OF USER LIST-->
                        							<div class = "col-sm-3" ><!--Rules Select Section-->
                            							<label>Current Rules</label><p>Select from dropdown menue to change values</p>
                            								<!--Where rules and selection are listed to from AJAX function-->
                            								<form methoid = "post">
                             								<table   class="table table-striped table-bordered table-hover" id="RuleSets">
                             		<?php						$pull = DB::getInstance()->query("SELECT total_data FROM macRulesTable ");
                                    							foreach($pull->results() as $pullData){
                                    							}
                                    ?>	
                                    							<tr><td>Access to Internet:  </td>
                                    							<td><select type = 'select' id = "block"><option value = "0" >Granted</option><option value = "1">Denied</option></select></td></tr>
                                    							<tr><td>Downloading Limit:  </td>
																<td><select type = 'select' id = "DL"><option>No Limit</option>
                                    <?php    						
                                        						$tot = ($pullData->total_data/1000000000);
                                        						while($tot>0):
                                            						$tot = $tot - 5;
                                            						echo'<option>'.$tot.'</option>';
                                        						endwhile;
                                    ?>
                                        						</select></td><td><select type = 'select' id = "dl_unit"><option>GB</option><option>MB</option></select></td></tr>   
																<tr><td>Access Start Time: </td>
																<td><select type = 'select' id= "st"><option>No Limit</option>
                                    <?php    						
                                        						$i = 12;
                                        						while($i>0):
                                            						echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                           							$i--;
                                        						endwhile;
                                    ?>    						
                                        						</select></td><td><select type = 'select' id = "st_ampm"><option>AM</option><option>PM</option></select></td></tr>
																<tr><td>Accesss End Time: </td>
																<td><select type = 'select' id = "endt"><option>No Limit</option>
                                    <?php    						
                                        						$i = 12;
                                        						while($i>0):
                                            						echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                            						$i--;
                                        						endwhile;
                                    ?>    						
                                        						</select></td><td><select type = 'select' id = "endt_ampm"><option>AM</option><option>PM</option></select></td></tr>
																<tr><td>Speed of Access: </td>
																<td><select type = select id = "speed">
                                        							<option>No Limit</option>
                                        							<option>Slow</option>
                                        							<option>Medium</option>
                                        							<option>Fast</option>
                                        							</select>
                                        						</td>
                                        						</tr>  	
                                 							</table>
                                 							</form>
                                 							<input type="submit" class="btn btn-primary btn-block"  onclick = "Pass('hold')" value="Enter" id = "new">
                        							</div><!--RULES SELECTION ENDS HERE-->
                        							<div class = "col-sm-6"><!--ENTERED USER RULES TABLE-->
                        								<label>New Rules</label>
                        								<table   class="table table-striped table-bordered table-hover" >
                                                  			<thead>
                                       							<tr>
                                                            		<th>Device Name</th>
                                                            		<th>Access to Internet</th>
                                                            		<th>Downloading Limit</th>
                                                            		<th> </th>
                                                            		<th>Access Start Time</th>
                                                            		<th> </th>
                                                            		<th>Accesss End Time</th>
                                                            		<th> </th>
                                                            		<th>Speed of Access</th>
                                                        		</tr>
                                                    		</thead> 
                                                    		<tbody id = "NewRules">
                                                    		</tbody>     
                                                		</table>
                                                        <input type="submit" class="btn btn-success"  onclick = "StoreNew()" value="Confirm">
                        							</div><!--RULES TABLE ENDS HERE-->
                        						</div><!--Form group ENDS HERE--> 
                    						</div><!--Pannel body ENDS HERE-->
            							</div><!--Pannel default ENDS HERE-->
        							</div><!--col-lg-4.5 ENDS HERE-->
    							</div><!--row ENDS HERE-->
							</div><!--Setting Tab ENDS HERE-->
						</div><!--Tab-Contendt ENDS HERE-->
                    </div><!--Pannel-Body ENDS HERE-->
                </div><!--Pannel ENDS HERE-->
            </div><!--sub-col-lg-12 ENDS HERE-->
        </div><!--Page-Wrapper ENDS HERE-->    	
	</div><!--Wrapper ENDS HERE-->
</body><!--BODY ENDS HERE-->

	
</html>
<?php
} else {
	echo 'You need to <a href="login.php">log in</a> or <a href="register.php">register</a>!';
}
?>	
