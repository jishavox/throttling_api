<?php
include('db.php');
$sql="SELECT * FROM api_token ";
$res= mysqli_query($con,$sql);
 if(isset($_GET['d_id']))
{
    $d_id=$_GET['d_id'];
    mysqli_query($con,"update api_token set status=0 where id=$d_id "); // deactivate API Token 
}

    if(isset($_POST['submit']))
    {
        $key=$_POST['key'];
        $hitlimit=$_POST['hitlimit'];
        $time=$_POST['time'];
        $status=$_POST['status'];
        $sql ="INSERT INTO `api_token` (`token`, `hit_limit`,`time_limit`,'last_time',`status`) VALUES ('$key', '$hitlimit', '$time','', '$status')";
//print_r($sql);exit;
         mysqli_query($con,$sql);// Add New API Token
         
    }

?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}
/* input box styling */
input[type=text],[type=number], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4586a0;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
 
}

input[type=submit]:hover {
  background-color: #4586a0;
}
/* end input box styling */

/* Responsive style */
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}
.col-100 {
  
  width: 100%;
  margin-top: 6px;
  padding-top:6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
/* End Responsive style */
/* Table style */
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

/* End Table style */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

</style>
</head>
<body>

<h2>API Configuration</h2>

<div class="container">
    <!-- Form to add new access token for API -->
  <form action="" method="POST">
    <div class="row">
      <div class="col-25">
        <label for="fname">API Key</label>
      </div>
      <div class="col-75">
        <input type="text" id="key" name="key" placeholder="Your name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Hit Limit</label>
      </div>
      <div class="col-75">
        <input type="number" id="hitlimit" name="hitlimit" placeholder="Hit Limit..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Hit Limit Time in Secons</label>
      </div>
      <div class="col-75">
     <input type="number" id="time" name="time" placeholder="Time in Secons..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Status</label>
      </div>
      <div class="col-75">
          <select  name="status">
          <option value="1">Activate</option>
          <option value="0">Deactivate</option>
        
        </select>
        </div>
    </div>
    <div class="row">
	<div class="col-100">
      <input type="submit" name="submit" value="Submit">
	  </div>
    </div>
  </form>
  <!-- end form -->
  <!-- List the access tokens -->
  <h4>API Key List</h4>
    <table>
    <tr>
      <th>Api Key</th>
      <th>Hit Limit</th>
      <th>Time Limit</th>
      <th>Status</th>
      <th>Edit</th>
      <th>Deactivated</th>
     
    </tr>
  <?php   while($row=mysqli_fetch_assoc($res))
                            {
                                ?>
    <tr>
      <td><?php echo $row ['token']; ?></td>
      <td><?php echo $row ['hit_limit']; ?></td>
      <td><?php echo $row ['time_limit']; ?></td>
      <td><?php echo $row ['status']; ?></td>
      <td><a href="api_config_edit.php?g_id=<?php echo $row ['id']; ?>">Edit</a></td>
      <td><a href="api_config.php?d_id=<?php echo $row ['id']; ?>">Deactivated</a></td>
   
    </tr>
    <?php } ?>
  </table>
  <!-- end listing -->
</div>

</body>
</html>
