<?php
include('db.php');
$sql="SELECT * FROM api_token ";
$res= mysqli_query($con,$sql);
$g_id=$_GET['g_id'];
if(isset($_GET['g_id']))
{
    
   $checkres = mysqli_query($con,"SELECT * FROM api_token WHERE id=$g_id"); 
     $checkrow = mysqli_fetch_assoc($checkres);
}
 if(isset($_POST['submit']))
    {
        $key=$_POST['key'];
        $hitlimit=$_POST['hitlimit'];
        $time=$_POST['time'];
        $status=$_POST['status'];
        $query="update api_token set token='$key',hit_limit=$hitlimit,time_limit=$time,status=$status where id=$g_id ";
       // print_r($query);exit;
mysqli_query($con,$query);
header("location:api_config.php");
         
    }

?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

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

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
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

tr:nth-child(even){background-color: #f2f2f2}
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}

</style>
</head>
<body>

<h2>API Configuration Edit</h2>

<div class="container">
    
  <form action="" method="POST">
    <div class="row">
      <div class="col-25">
        <label for="fname">API Key</label>
      </div>
      <div class="col-75">
        <input type="text" id="key" name="key" value="<?php echo $checkrow['token']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Hit Limit</label>
      </div>
      <div class="col-75">
        <input type="number" id="hitlimit" name="hitlimit"  value="<?php echo $checkrow['hit_limit']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Hit Limit Time in Secons</label>
      </div>
      <div class="col-75">
     <input type="number" id="time" name="time"  value="<?php echo $checkrow['time_limit']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Status</label>
      </div>
      <div class="col-75">
          <select  name="status">
          <option value="1" <?php if($checkrow['status']==1){ echo "Selected";} ?>>Activate</option>
          <option value="0" <?php if($checkrow['status']==0){ echo "Selected";} ?>>Deactivate</option>
        
        </select>
        </div>
    </div>
    <div class="row">
      <input type="submit" name="submit" value="Update">
    </div>
  </form>

</div>

</body>
</html>
