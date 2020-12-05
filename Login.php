<html>
<head>
 
    <link rel="stylesheet" href="LoginCs.css">

</head>

<?php
  session_start();
  if(isset($_SESSION['rollNo'])) {
    header('location: home.php');
  }
  if(isset($_POST['logout'])) {
    session_destroy();
  }
  //$conn= mysqli_connect('localhost', 'root', '','leave');
  include_once('connection.php');
	if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
	}
	if(isset($_POST['log'])) {
		$name = htmlspecialchars($_POST['rollNo']);
    $pass = htmlspecialchars($_POST['psw']);
    if(($name=="admin")&&($pass=="admin")){
      $_SESSION['rollNo'] = $name;
      header("location: admin.php");
    }
    else{
      // header("location: home.php");
      // echo $name." ".$pass;
      $sql = "INSERT INTO login(Roll_No, Password) VALUES('{$name}', '{$pass}')";
		
      if(mysqli_query($conn, $sql)) {
        echo "<script>console.log('Inserted');</script>";
        $_SESSION["rollNo"] = $name;
        header("location: home.php");
      } else {
        echo "<script>console.log('Error');</script>";
      }
    }
	}
?>

<body>
    <div>

  <form class="container" action="Login.php" method="post">
    <h1>Login</h1>

    <label for="Roll No"><b>Roll Number</b></label>
    <input type="text" placeholder="Enter Roll Number" name="rollNo" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    <input type="submit" class="btn" value="Login" name="log">
    <!-- <button class="btn" type="submit">Login</button> -->
  </form>

  <script>
    
  </script>
  
</body>
</html>