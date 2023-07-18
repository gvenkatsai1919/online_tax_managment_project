<?php 
$conn=new mysqli("localhost","root","","onlinetaxmanagementsystem");
$reg_id=$_SESSION['reg_id'];
$sql="select fname from client where reg_id='$reg_id';";
$get_name = mysqli_fetch_assoc($conn->query($sql))['fname'];
?>

<div class="topnav">
    <!-- Centered link -->
    <div class="topnav-centered">
        <a href="Home.php"><img class="logo" src="logo.png"></a>
    </div>

    <!-- Left-aligned links (default) -->
    <a class="al" href="Home.php">Tax Managment</a>

    <!-- Right-aligned links -->
    <div class="topnav-right"> 
        <a class="al" href="Home.php">Home</a>
        <a class="al" href="application.php" >Application</a>
        <a class="al" href="schedule.php">Schedule</a>
        <a class="al" href="payment.php">Payment</a>
        <a class="al" title="Click to Logout"  href="login.php"><?php if($get_name!="") echo $get_name; else echo "New User";?></a>
    </div>        
</div>