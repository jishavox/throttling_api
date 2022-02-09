<?php
// check the request send or not
If(isset($_POST["submit"])){
    // set url with access token key 
$url="http://localhost/api/index.php?key=njnkjnjkn";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
$result =curl_exec($ch);
curl_close($ch);
 $result=json_decode($result,true);

if(isset($result['status']))
{
    if($result['status']==true)
    {
        if(isset($result['result']))
            {
                if($result['result']==true)
                {
                  // Preview the Data List
                   ?>
                   <h3>Data List</h3>
                  <table>
                      <tr>
                          <td>ID  </td>
                          <td>NAME  </td>
                          <td>EMAIL  </td>
                      </tr>
                      <?php
                       foreach($result['data'] as $list)
                       {
                           echo "<tr><td>".$list['id']."</td>
                           <td>".$list['name']."</td>
                           <td>".$list['email']."</td></tr>";
                           
                       }
                       
                      ?>
                  </table> 
                   
             <?php      
                }
            }
    }
    else
    {
        echo $result['data'];
        
    }
}
else
{
    echo "API not working";
}

}
// Set The request button
echo "<h3>Click Button To Get Data</h3>
<form  method='post'>
    <input type='submit' name='submit' value='Get Data'>
</form>";
?>
<style>
 /*-- UI Style CSS --*/   
    input[type=submit] {
  background-color: #4586a0;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: center;
}

input[type=submit]:hover {
  background-color: #4586a0;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

</style>
