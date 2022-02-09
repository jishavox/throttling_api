<?php
include('db.php');
// Check API Access Token is Passed or Not
if(isset($_GET['key']))
{
    $key=mysqli_real_escape_string($con,($_GET['key']));
    $checkres = mysqli_query($con,"SELECT * FROM api_token WHERE token='$key'"); // Select API Access Token Details based on passed Key
        if(mysqli_num_rows($checkres)>0)
        {
            
            $checkrow = mysqli_fetch_assoc($checkres);
            if($checkrow['status']==1) // Check API access token active or not
            {
                if($checkrow['last_time']=='') // Check last requested time from table is empty then set current time as last_time
                {
                    $date=date("Y-m-d h:i:s");
                     mysqli_query($con,"update api_token set last_time='$date',hit_count=0 where token='$key' "); 
					 // check  hit count exceed or not
                       if($checkrow['hit_count'] >= $checkrow['hit_limit']){
                     echo json_encode(['status'=>false,'data'=>'API Hit Limit Exceed!']);
                     die();
                        }
                        else
                        {
                            mysqli_query($con,"update api_token set hit_count=hit_count+1 where token='$key' ");
                        }
                }
                else 
                {
                    $last = strtotime($checkrow['last_time']);
                    $curr = strtotime(date("Y-m-d h:i:s"));
                    $sec =  abs($last - $curr);
					// check  the time limit  : Throttling implementation
                    if($sec<=$checkrow['time_limit'])
                    {
						// check  hit count exceed or not
                        if($checkrow['hit_count'] >= $checkrow['hit_limit']){
                     echo json_encode(['status'=>false,'data'=>'API Hit Limit Exceed!']);
                     die();
                        }
                        else
                        {
                            mysqli_query($con,"update api_token set hit_count=hit_count+1 where token='$key' ");
                        }
                
                    }
                    else
                    {
                       mysqli_query($con,"update api_token set last_time='', hit_count=0 where token='$key' ");   
                    }
                                    
                }
                
            // Data Retrive from user table
                      $sql="SELECT * FROM user ";
                        $res= mysqli_query($con,$sql);
                        $count=mysqli_num_rows($res);
                     

 
                        header('Content-Type: application/json');

            
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $arr[]=$row;
                                }
                               // If table content count>0 datalist set data list
                               echo json_encode(['status'=>true,'data'=>$arr,'result'=>'found']);
                        
                        }
                        else
                        {
                           // If table content count=0 Display no data found 
                            echo json_encode(['status'=>false,'data'=>'No data found!','result'=>'Not']);
                        } 
              }
              else
              {
				   // If API access token status=0 Display API Deactivated
                 echo json_encode(['status'=>false,'data'=>'API Deactivated']);  
              }
                        
           
   
        }
        else
        {
			  // If wrong API access token set Display 'Plese Provide a valid API token'
            echo json_encode(['status'=>false,'data'=>'Plese Provide a valid API token']);
        }

}
else
{
	// If  API key is empty Display 'Plese Provide API token'
     echo json_encode(['status'=>false,'data'=>'Plese Provide API token']);
}


?>
