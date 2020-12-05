<html>
<head>
<title Admin Page></title>
<body>
<style>
    body {
      background-image: url('2511619.jpg');
      background-size: 1600px 750px;
      background-repeat: no-repeat;
      min-height: 100vh;
    }
    </style>

<style>
div {
  background-color: white;
  /*background-image: url('2.jpg');*/
  width: 300px;
  border: 5px solid #939393;
  border-radius: 30px;
  padding: 50px;
  margin: 20px;
}
</style>

<style type="text/css">
      .ap-btn {
        /*margin-top: 100px;*/
        /* background-color: #f15757; */
        background-color: white;
        font-family:Algerian;
        color: black;
        padding: 10px 10px;
        /*border: none;*/
        border: 2px solid black;
        border-radius: 15px;
        cursor: pointer;
        /* width: 100%; */
        /* opacity: 0.9; */
        letter-spacing: 1px;
        font-size: 18px;
        text-transform: uppercase;
        /*transition: 0.3s ease;*/
        position: relative;
        /*margin-right: 10px; */
      }
      /*.ap-btn:hover{
        background-color: #f44336;
        color: white;
      }*/
    </style>


<?php

// Create connection
//$conn = mysqli_connect('localhost', 'root', '','leave');
include_once('connection.php');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $sql1 = "UPDATE apply SET l_status='$status' WHERE id=$id";
    mysqli_query($conn, $sql1);
    header('location: admin.php');
}

$sql = "SELECT * FROM apply WHERE rollno = ANY(SELECT rollno FROM apply WHERE l_status='Unknown')";
$result = mysqli_query($conn, $sql);
// $row=mysqli_fetch_assoc($result);
// print_r($row);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    // $row=mysqli_fetch_assoc($result);
    // print_r($result);
    while($row = mysqli_fetch_assoc($result)) {
        // echo "Roll No: " . $row["rollno"].  "<br>";
        $id = $row['id'];
        $rollno = $row['rollno'];
        $type=$row['leavetype'];
        $from=$row['l_from'];
        $to=$row['l_to'];
        $reason=$row['reason'];
    }
} else {
    echo "No Leave forms pending";
}

/*mysqli_close($conn);*/
?>

<center>
<div>


<form action="http://localhost/project/admin.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
  <h1>Leave Request Form</h1><br>

  <h3>Roll No.</h3>
  <input type="text" class="ap-btn" id="roll" name="roll" value=" <?php echo $rollno ?>"><br>

  <h3>Pass Type</h3>
  <input type="text" class="ap-btn" id="type" name="type" value="<?php echo $type ?>"><br>

  <h3>From</h3>
  <input type="text" class="ap-btn" id="from" name="from" value="<?php echo $from ?>"><br>

  <h3>To</h3>
  <input type="text" class="ap-btn" id="to" name="to" value="<?php echo $to ?>"><br>

  <h3>Reason</h3>
  <input type="text" class="ap-btn" id="reason" name="reason" value="<?php echo $reason ?>"><br>

  <h3>Status</h3>
  <select name="status" id="status" class="ap-btn">
  <option value="Approved">Approved</option>
  <option value="Rejected">Rejected</option>
  </select><br><br>

<input type="submit" class="ap-btn" id="submit" name="submit" value ="Submit">

</form>

<form action="http://localhost/project/login.php" method="post">
      <input class="ap-btn" type="submit" name="logout" value="Logout">    
    </form>

</div>
</center>

</body>
</head>
</html>