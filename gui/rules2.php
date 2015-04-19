             <?php
             require 'core/init.php';

                    $who = $_REQUEST["MAC"];
                   
                                    $pull = DB::getInstance()->query("SELECT terminal_name, block, user_total, start_time, stop_time, bw_limit, total_data, total_bw  FROM macRulesTable WHERE mac = ".$who);
                                    foreach($pull->results() as $pullData){
                                    echo'<tr><td>Device</td><td id = "name">'.$pullData->terminal_name.'</td></tr>';    
                                    echo'<tr><td>Access to Internet:  </td>';
                                    if($pullData->block == 0){
                                        echo'<td><select type = select name = "block"><option>Granted</option><option>Denied</option></select></td></tr>';
                                    }else{
                                        echo'<td><select type = select name = "block"><option>Denied</option><option>Granted</option></select></td></tr>';
                                    }
                                    echo'<tr><td>Downloading Limit:  </td>';
                                    if($pullData->user_total==$pullData->total_data){
                                        echo'<td><select type = select name = "DL"><option>No Limit</option>';
                                        $tot = ($pullData->total_data/1000000000);
                                        while($tot>0):
                                            $tot = $tot - 5;
                                            echo'<option>'.$tot.'</option>';
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "dl_unit"><option>GB</option><option>MB</option></select></td></tr>';    
                                    }elseif($pullData->user_total>1000000000){
                                        echo '<td><select type = select name = "DL"><option>'.($pullData->user_total/1000000000).'</option><option>No Limit</option>';
                                        $tot = ($pullData->total_data/1000000000);
                                        while($tot>0):
                                            $tot = $tot - 5;
                                           if($tot!=($pullData->total_data/1000000000)){
                                                echo'<option>'.$tot.'</option>';
                                            }
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "dl_unit"><option>GB</option><option>MB</option></select></td></tr>';
                                    }else{
                                        echo '<td><select type = select name = "DL"><option>'.($pullData->user_total/1000000).'</option><option>No Limit</option>';
                                        $tot = ($pullData->total_data/1000000000);
                                        while($tot>0):
                                            $tot = $tot - 5;
                                            if($tot!=($pullData->total_data/1000000000)){
                                                echo'<option>'.$tot.'</option>';
                                            }
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "dl_unit"><option>MB</option><option>GB</option></select></td></tr>';
                                    }
                                    echo'<tr><td>Access Start Time: </td>';
                                    $hour = explode(":",$pullData->start_time);
                                    if($pullData->start_time=='00:00:00'){
                                        echo'<td><select type = select name = "st"><option>No Limit</option>';
                                        $i = 12;
                                        while($i>0):
                                            echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                            $i--;
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "st_ampm"><option>AM</option><option>PM</option></select></td></tr>';
                                    }elseif($pullData->start_time==$pullData->stop_time){
                                         echo'<td><select type = select name = "st"><option>Blocked (Start Time = End Time)</option>'; 
                                         $i = 12;
                                        while($i>0):
                                            echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                            $i--;
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "st_ampm"><option>AM</option><option>PM</option></select></td></tr>';    
                                    }elseif($hour[0]>12){    
                                        echo'<td><select type = select name = "st"><option>'.($hour[0]-12).":".$hour[1].":".$hour[2].'</option><option>No Limit</option>';
                                        $i = 12;
                                        while($i>0):
                                            if($i!=$hour[0]){
                                                echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                                $i--;
                                            }
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "st_ampm"><option>PM</option><option>AM</option></select></td></tr>';
                                    }else{
                                        echo '<td><select type = select name = "st"><option>'.$pullData->start_time.'</option><option>No Limit</option>';
                                        $i = 12;
                                        while($i>0):
                                            if($i!=$hour[0]){
                                                echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                                $i--;
                                            }
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "st_ampm"><option>AM</option><option>PM</option></select></td></tr>';
                                    }    
                                    echo'<tr><td>Accesss End Time: </td>';
                                    $hour = explode(":",$pullData->stop_time);
                                    if($pullData->start_time=='00:00:00'){
                                        echo'<td><select type = select name = "endt"><option>No Limit</option>';
                                        $i = 12;
                                        while($i>0):
                                            echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                            $i--;
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "endt_ampm"><option>AM</option><option>PM</option></select></td></tr>';
                                    }elseif($pullData->start_time==$pullData->stop_time){
                                         echo'<td><select type = select name = "endt"><option>Blocked (Start Time = End Time)</option>'; 
                                         $i = 12;
                                        while($i>0):
                                            echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                            $i--;
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "endt_ampm"><option>AM</option><option>PM</option></select></td></tr>';  
                                    }elseif($hour[0]>12){    
                                        echo'<td><select type = select name = "endt"><option>'.($hour[0]-12).":".$hour[1].":".$hour[2].'</option><option>No Limit</option>';
                                        $i = 12;
                                        while($i>0):
                                            if($i!=$hour[0]){
                                                echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                                $i--;
                                            }
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "endt_ampm"><option>PM</option><option>AM</option></select></td></tr>';
                                    }else{
                                        echo '<select type = select name = "endt"><option>'.$pullData->stop_time.'</option><option>No Limit</option>';
                                        $i = 12;
                                        while($i>0):
                                            if($i!=$hour[0]){
                                                echo'<option>'.$i.':00:00</option><option>'.$i.':30:00</option>'; 
                                                $i--;
                                            }
                                        endwhile;
                                        echo'</select></td><td><select type = select name = "endt_ampm"><option>AM</option><option>PM</option></select></td></tr>';
                                    }    
                                    echo'<tr><td>Speed of Access: </td>';
                                    if($pullData->bw_limit==$pullData->total_bw){
                                        echo'<td><select type = select name = "speed"><option>No Limit</option><option>Slow</option><option>Medium</option></select></td></tr>';  
                                        $sp = $pullData->total_bw;
                                    }elseif($pullData->bw_limit==($pullData->total_bw/2)){ //slow = 10%, med = 25%, fast = 50%
                                        echo'<td><select type = select name = "speed"><option>Fast</option><option>Medium</option><option>Slow</option><option>No Limit</option></select></td></tr>';  
                                    }elseif($pullData->bw_limit<($pullData->total_bw/4)){
                                        echo'<td><select type = select name = "speed"><option>Slow</option><option>Medium</option><option>Fast</option><option>No Limit</option><option>Slow</option></select></td></tr>';
                                    }else{
                                        echo'<td><select type = select name = "speed"><option>Medium</option><option>Slow</option><option>Fast</option><option>No Limit</option></select></td></tr>';
                                    }
                                 }
                                                
                          
?>

