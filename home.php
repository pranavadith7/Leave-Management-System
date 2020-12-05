<!DOCTYPE html>
 <html lang="en-US">
   <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Homecss.css">
    <script src="http://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <title>Home</title>
    <style type="text/css">
      .ap-btn {
        margin-top: 100px;
        /* background-color: #f15757; */
        background-color: white;
        font-family:Algerian;
        color: black;
        padding: 18px 20px;
        /*border: none;*/
        border: 2px solid red;
        border-radius: 15px;
        cursor: pointer;
        /* width: 100%; */
        /* opacity: 0.9; */
        letter-spacing: 1px;
        font-size: 18px;
        text-transform: uppercase;
        transition: 0.3s ease;
        position: relative;
        /*margin-right: 10px; */
      }
      .ap-btn:hover{
        background-color: #f44336;
        color: white;
      }
    </style>

    <?php
      date_default_timezone_set('Asia/Kolkata');
    ?>
    <?php
      session_start();
      if(!isset($_SESSION['rollNo'])) {
        header('location: Login.php');
      }
      // Connection
      //$conn= mysqli_connect('localhost', 'root', '','leave');
      include_once('connection.php');

      $session_roll = $_SESSION['rollNo'];
      $sql1 = "SELECT l_status FROM apply WHERE rollno=$session_roll";
      $result1 = mysqli_query($conn, $sql1);
      if(mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        // print_r($_SESSION);
        // print_r($row);
        $l_status = $row['l_status'];
      } else {
        $l_status = "Unknown";
        echo "<script>console.log('No roll No')</script>";
      }

      if (!$conn) {
        echo "Connection failed: " . mysqli_connect_error();
      }
      if(isset($_POST['apply'])) {
        $roll = htmlspecialchars($_SESSION['rollNo']);
        $type = htmlspecialchars($_POST['passtype']);
        $from = htmlspecialchars($_POST['from']);
        $to = htmlspecialchars($_POST['to']);
        $reason = htmlspecialchars($_POST['reason']);

        $sql = "INSERT INTO apply(rollno, leavetype, l_from, l_to, reason) VALUES({$roll}, '{$type}', '{$from}', '{$to}', '{$reason}')";
        if(mysqli_query($conn, $sql)) {
          echo "<script>window.alert('Applied')</script>";
          // $_SESSION["rollno"] = $name;
          header("location: success.html");
        } else {
          echo "<script>window.alert('Error');</script>";
        }
      }
      // print_r($_SESSION);
    ?>

</head>

   <body>
   <form action="Login.php" method="post">
      <div class="field btns">
        <input class="ap-btn" type="button" onclick="BalFunc()" id="BalButton" name="sample" value="Balance Leaves"><br>
        <input class="ap-btn" type="button" onclick="StatusFunc()" id="StatusButton" name="sample" value="Leave Status"><br>
        <!--<input class="ap-btn" type="button" name="sample" value="Edit Profile"><br>-->
        <!-- <input class="ap-btn" type="button" name="sample" value="Logout"> -->
      </div>
      <input class="ap-btn" type="submit" name="logout" value="Logout">    
    </form>
    <!--<input class="ap-btn" type="button" onclick="BalFunc()" id="BalButton" name="sample" value="Balance Leaves"><br>-->
    

    <?php
    $l=2;
    if($l_status=="Approved"){
      $l=$l-1;
    }
    else{
      $l=$l;
    }
    ?>

    <script>
    var flag=1;
  
      function BalFunc(){
        if (flag==1){
        document.getElementById("BalButton").value="Leaves Left  :  <?php echo $l ?>";
        flag=0;
    }
        else{
          document.getElementById("BalButton").value="Balance Leaves";
          flag=1; 
      }
    }
    
     function StatusFunc(){
       document.getElementById("StatusButton").value="<?php echo $l_status ?>";
     } 

    </script>
   
    <div class="container">
      
      <header>Leave Form</header>

        <div class="form-outer">

          <form action="home.php" method="post">

            <div class="page ">
             
                <div class="field">
                  
                   <select name="passtype">
                    <option value="Home Pass">Home Pass</option>
                    <option value="Day Pass">Day Pass</option>
                  </select>
                </div>
                <div class="field">
               
                  <input type="text" id="From" value="From" readonly >
                  <!-- <label for="From">From</label><br> -->
                  <!-- <input type="datetime-local" id="From" name="From" value=' required> -->
                </div>
                <div class="field">
                  
                <input type="datetime-local" id="From" name="from" value='<?php echo date("Y-m-d\TH:i",time()); ?>' required>
               </div>
               
               <div class="field">
                 
                <input type="text" id="To" value="To" readonly >
               </div>
               <div class="field">  
                
               <input type="datetime-local" id="to" name="to" value='<?php echo date("Y-m-d\Th:i",time()); ?>' required>
               </div>
             
               <div class="field">
                 
                  <input type="text" name="reason" placeholder="Reason">
                </div>
                <div class="field btns">

                  <button class="apply" type="submit" name="apply">Apply</button>
                </div>
              
                

            </div>
          </form>
        </div>

    </div>

  
  </body> 
  </html>