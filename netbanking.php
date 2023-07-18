<?php
require 'clean.php';
session_start();
$reg_id=$_SESSION['reg_id'];
$pay_id=$_SESSION['pay_id'];
$conn=new mysqli("localhost","root","","onlinetaxmanagementsystem");
if(isset($_POST['new_acc'])){
	$accno=clean($_POST['accno']);
	$pwd=clean($_POST['password']);
	$bname=clean($_POST['bname']);
	$sql="insert into acc_details values('$accno','$pwd','$bname');";
	if($conn->query($sql)==TRUE){
		$sql="insert into acc_no values('$reg_id','$accno');";
		if($conn->query($sql)==TRUE){
			$conn->query("update payment set pay_status='done' where pay_id='$pay_id'");
?>
			<script>
			window.open('success.php','_self');
			</script> 
<?php
		}
		else{
?>
			<script type="text/javascript">
				alert("Error occured!!");
			</script>
<?php
		}
	}
	else{
?>
        <script type="text/javascript">
        	alert("Error occured!!");
        </script>
<?php
    }
}
if(isset($_POST['your_acc'])){
	$accno=clean($_POST['nb']);
	$pwd=clean($_POST['password']);
	$sql="select acc_pwd from acc_details where acc_no='$accno';";
	$result=mysqli_query($conn,$sql);
	$get_pwd = mysqli_fetch_assoc($result)['acc_pwd'];
	if($get_pwd==$pwd){
		$conn->query("update payment set pay_status='done' where pay_id='$pay_id'");
?>
		<script>
		window.open('success.php','_self');
		</script>
<?php
	}
	else{
?>
		<script>
		alert("Invalid Password!!");
		</script>
<?php
	}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Net Banking</title>
	<link rel="stylesheet" href="style.css">
	<style>
		* {
			padding: 0;
			margin: 0;
		}
		.container {
			position: relative;
			justify-content: center;
			margin: 100px 120px;
			display: inline-block;
			width: 450px;
			height: auto;
			background: #dedede;
			border-radius: 5px;
			box-shadow: 10px 15px 20px rgba(0, 0, 0, .6);

		}

		.label {
			padding: 20px 130px;
			font-size: 35px;
			font-weight: bold;
			color: #130f40;
		}

		.login_form {
			padding: 20px 40px;
		}

		.login_form .font {
			font-size: 18px;
			color: #130f40;
			margin: 5px 0;
		}

		.login_form input {
			height: 40px;
			width: 350px;
			padding: 0 5px;
			font-size: 18px;
			outline: none;
			border: 1px solid silver;
		}

		.login_form .font2 {
			margin-top: 30px;
		}

		.login_form button {
			margin: 45px 0 30px 0;
			height: 45px;
			width: 365px;
			font-size: 20px;
			color: white;
			outline: none;
			cursor: pointer;
			font-weight: bold;
			background: #1A237E;
			border-radius: 3px;
			border: 1px solid #3949AB;
			transition: .5s;
		}

		.login_form button:hover {
			background: #151c6a;
		}

		.login_form #accno_error,
		.login_form #pass_error,
		.login_form #bname_error,
		.login_form #accno_error1,
		.login_form #pass_error1 {
			margin-top: 5px;
			width: 345px;
			font-size: 18px;
			color: #C62828;
			background: rgba(255, 0, 0, 0.1);
			text-align: center;
			padding: 5px 8px;
			border-radius: 3px;
			border: 1px solid #EF9A9A;
			display: none;
		}
		.nb select {
			background-color: #1A237E;
			color: white;
			padding: 12px;
			width: 250px;
			border: none;
			font-size: 15px;
			box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
			-webkit-appearance: button;
			appearance: button;
			outline: none;
		}

		.nb select option {
			padding: 30px;
		}
	</style>
</head>

<body>
	<?php include 'navBar.php';?>
	<div class="container">
		<h1 class="label">Your Accounts</h1>
		<form class="login_form" action="netbanking.php" method="POST" name="form1" onsubmit="return validated1()">
			<label class="font" for="nb">Account Number</label>
			<div class="nb">
			<select name="nb" id="card">
			<option value="">Select</option>
			<?php
			$sql="select acc_no from acc_no where reg_id='$reg_id'";
			$get_user = mysqli_query($conn, $sql);
			while (($acc_nos = mysqli_fetch_assoc($get_user))!=null) {?>
				<option value="<?php echo $acc_nos['acc_no'];?>"><?php echo $acc_nos['acc_no'];?></option>
			<?php
			}
			?>
			</select>
			</div>
			<div id="accno_error1">Please fill up your account number</div>
			<div class="font font2">Password</div>
			<input type="password" name="password">
			<div id="pass_error1">Please fill up your Password</div>
			<button name="your_acc" type="submit">Pay</button>
		</form>
	</div>
	<div class="container">
		<h1 class="label">New account</h1>
		<form class="login_form" action="netbanking.php" method="POST" name="form" onsubmit="return validated()">
			<div class="font">Account Number</div>
			<input autocomplete="off" type="text" name="accno">
			<div id="accno_error">Please fill up your account number</div>
			<div class="font font2">Password</div>
			<input type="password" name="password">
			<div id="pass_error">Please fill up your Password</div>
			<div class="font font2">Bank name</div>
			<input autocomplete="off" type="text" name="bname">
			<div id="bname_error">Please fill up your account number</div>
			<button name="new_acc" type="submit">Pay</button>
		</form>
	</div>
	<script>
		//Validtion Code For Inputs
		function validated1() {
			var accno = document.forms['form1']['nb'];
			var password = document.forms['form1']['password'];

			var accno_error = document.getElementById('accno_error1');
			var pass_error = document.getElementById('pass_error1');

			accno.addEventListener('textInput', accno1_Verify);
			password.addEventListener('textInput', pass_Verify);
			if (accno.value == "") {
				accno.style.border = "1px solid red";
				accno_error.style.display = "block";
				accno.focus();
				return false;
			}
			if (password.value.length == 0) {
				password.style.border = "1px solid red";
				pass_error.style.display = "block";
				password.focus();
				return false;
			}

		}

		function validated() {
			var accno = document.forms['form']['accno'];
			var password = document.forms['form']['password'];
			var bname = document.forms['form']['bname'];

			var accno_error = document.getElementById('accno_error');
			var pass_error = document.getElementById('pass_error');
			var bname_error = document.getElementById('bname_error')

			accno.addEventListener('textInput', accno_Verify);
			password.addEventListener('textInput', pass_Verify);
			bname.addEventListener('textInput', bname_Verify);
			if (accno.value.length < 9) {
				accno.style.border = "1px solid red";
				accno_error.style.display = "block";
				accno.focus();
				return false;
			}
			if (password.value.length < 6) {
				password.style.border = "1px solid red";
				pass_error.style.display = "block";
				password.focus();
				return false;
			}
			if (bname.value.length == 0) {
				bname.style.border = "1px solid red";
				bname_error.style.display = "block";
				bname.focus();
				return false;
			}

		}

		function accno_Verify() {
			if (accno.value.length >= 8) {
				accno.style.border = "1px solid silver";
				accno_error.style.display = "none";
				return true;
			}
		}

		function accno1_Verify() {
			if (accno.value !="") {
				accno.style.border = "1px solid silver";
				accno_error.style.display = "none";
				return true;
			}
		}

		function pass_Verify() {
			if (password.value.length >= 5) {
				password.style.border = "1px solid silver";
				pass_error.style.display = "none";
				return true;
			}
		}
		function bname_Verify() {
			if (bname.value.length > 0) {
				bname.style.border = "1px solid silver";
				bname_error.style.display = "none";
				return true;
			}
		}
	</script>
</body>

</html>