<?php
require 'clean.php';
session_start();
$reg_id=$_SESSION['reg_id'];
$pay_id=$_SESSION['pay_id'];
$conn=new mysqli("localhost","root","","onlinetaxmanagementsystem");
if(isset($_POST['new_card'])){
	$cardno=$_POST['cardno'];
	$holder=$_POST['holder'];
	$month=$_POST['mm'];
	$year='20'.$_POST['year'];
	// echo $year;
	$cvv=$_POST['cvv']; 
	// echo $reg_id;
	$sql="insert into card_details values('$holder','$cardno','$year-$month-01','$cvv');";
	if($conn->query($sql)==TRUE){
		$sql="insert into card_no values('$reg_id','$cardno');";
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
if(isset($_POST['your_card'])){
	$cardno=$_POST['card'];
	$cvv=$_POST['cvv'];
	$sql="select cvv from card_details where card_no='$cardno';";
	$get_cvv = mysqli_fetch_assoc($conn->query($sql))['cvv'];
	if($get_cvv==$cvv){
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
		alert("Invalid CVV!!");
		</script>
<?php
	}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Credit/Debit Card</title>
	<link rel="stylesheet" href="style.css">
	<style>
		* {
			padding: 0;
			margin: 0;
		}
		.container {
			margin: 50px 120px;
			justify-content: center;
			display: inline-block;
			position: relative;
			margin-top: 100px;
			width: 450px;
			height: auto;
			background: #dedede;
			border-radius: 15px;
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

		.login_form .mmm {
			height: 40px;
			width: 100px;
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

		.login_form #cardno_error,
		.login_form #holder_error,
		.login_form #cvv_error,
		.login_form #cardno_error1,
		.login_form #cvv_error1{
			margin-top: 5px;
			width: 340px;
			font-size: 18px;
			color: #C62828;
			background: rgba(255, 0, 0, 0.1);
			text-align: center;
			padding: 5px 8px;
			border-radius: 3px;
			border: 1px solid #EF9A9A;
			display: none;
		}

		.login_form .mmerror,
		.login_form .yearerror {
			margin-top: 5px;
			width: 95px;
			font-size: 10px;
			color: #C62828;
			background: rgba(255, 0, 0, 0.1);
			text-align: center;
			padding: 5px 8px;
			border-radius: 3px;
			border: 1px solid #EF9A9A;
			display: none;
		}

		.card select {
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

		.card select option {
			padding: 30px;
		}
	</style>
</head>

<body>
<?php include 'navBar.php';?>
	<div class="container" style="margin-bottom: 70px;">
		<h1 class="label">Your Cards</h1>
		<form class="login_form" action="card.php" method="POST" name="form1" onsubmit="return validated1()">
			<!-- <div class="font">Card Number</div> -->
			<label class="font" for="card">Card Number</label>
			<div class="card">
			<select name="card" id="card">
			<option value="">Select</option>
			<?php
			$sql="select card_no from card_no where reg_id='$reg_id'";
			$get_user = mysqli_query($conn, $sql);
			while (($card_nos = mysqli_fetch_assoc($get_user))!=null) {?>
				<option value="<?php echo $card_nos['card_no'];?>"><?php echo $card_nos['card_no'];?></option>
			<?php
			}
			?>
			</select>
			</div>
			<div id="cardno_error1">Please fill up your account number</div>
			<div class="font font2">CVV</div>
			<input autocomplete="off" type="password" name="cvv">
			<div id="cvv_error1">Please fill up your cvv</div>
			<button name="your_card" type="submit">Pay</button>
		</form>
	</div>
	<div class="container">
		<h1 class="label">New Card</h1>
		<form class="login_form" action="card.php" method="POST" name="form" onsubmit="return validated()">
			<div class="font">Card Number</div>
			<input autocomplete="off" type="text" name="cardno">
			<div id="cardno_error">Please fill up your account number</div>
			<div class="font">Card Holdername</div>
			<input autocomplete="off" type="text" name="holder">
			<div id="holder_error">Please fill up your holder name</div>
			<table>
				<tr>
					<td style="width: 200px;">
						<div class="font font2">Month</div>
						<input class="mmm" autocomplete="off" type="mm" name="mm">
						<div id="mm_error" class="mmerror">Please fill expiry month</div>
					</td>
					<td>
						<div class="font font2">Year</div>
						<input class="mmm" autocomplete="off" type="year" name="year">
						<div id="year_error" class="yearerror">Please fill expirey year</div>
					</td>
				</tr>
			</table>

			<div class="font font2">CVV</div>
			<input autocomplete="off" type="password" name="cvv">
			<div id="cvv_error">Please fill up your cvv</div>
			<button name="new_card" type="submit">Pay</button>
		</form>
	</div>
	<script>
		//Validtion Code For Inputs
		function validated1(){
			var cardno = document.forms['form1']['card'];
			var cvv = document.forms['form1']['cvv'];
			var cardno_error = document.getElementById('cardno_error1');
			var cvv_error = document.getElementById('cvv_error1');
			cardno.addEventListener('select', cardno1_Verify);
			cvv.addEventListener('textInput', cvv_Verify);
			if (cardno.value.length != 16) {
				cardno.style.border = "1px solid red";
				cardno_error.style.display = "block";
				cardno.focus();
				return false;
			}
			
			if (cvv.value.length != 3) {
				cvv.style.border = "1px solid red";
				cvv_error1.style.display = "block";
				cvv.focus();
				return false;
			}
		}
		

		function validated() {
			var cardno = document.forms['form']['cardno'];
			var holder = document.forms['form']['holder'];
			var mm = document.forms['form']['mm'];
			var year = document.forms['form']['year'];
			var cvv = document.forms['form']['cvv'];


			var cardno_error = document.getElementById('cardno_error');
			var holder_error = document.getElementById('holder_error');
			var mm_error = document.getElementById('mm_error');
			var year_error = document.getElementById('year_error');
			var cvv_error = document.getElementById('cvv_error');

			cardno.addEventListener('textInput', cardno_Verify);
			holder.addEventListener('textInput', holder_Verify);
			mm.addEventListener('textInput', mm_Verify);
			year.addEventListener('textInput', year_Verify);
			cvv.addEventListener('textInput', cvv_Verify);
			if (cardno.value.length != 16) {
				cardno.style.border = "1px solid red";
				cardno_error.style.display = "block";
				cardno.focus();
				return false;
			}
			if (holder.value.length <= 0) {
				holder.style.border = "1px solid red";
				holder_error.style.display = "block";
				holder.focus();
				return false;
			}
			if (mm.value.length != 2) {
				mm.style.border = "1px solid red";
				mm_error.style.display = "block";
				mm.focus();
				return false;
			}
			if (year.value.length != 2) {
				year.style.border = "1px solid red";
				year_error.style.display = "block";
				year.focus();
				return false;
			}
			if (cvv.value.length != 3) {
				cvv.style.border = "1px solid red";
				cvv_error.style.display = "block";
				cvv.focus();
				return false;
			}

		}
		function cardno1_Verify() {
			if (cardno.value == "") {
				cardno.style.border = "1px solid silver";
				cardno_error.style.display = "none";
				return true;
			}
		}

		function cardno_Verify() {
			if (cardno.value.length >= 8) {
				cardno.style.border = "1px solid silver";
				cardno_error.style.display = "none";
				return true;
			}
		}

		function holder_Verify() {
			if (holder.value.length > 0) {
				holder.style.border = "1px solid silver";
				holder_error.style.display = "none";
				return true;
			}
		}

		function mm_Verify() {
			if (mm.value.length >= 3) {
				mm.style.border = "1px solid silver";
				mm_error.style.display = "none";
				return true;
			}
		}

		function year_Verify() {
			if (year.value.length >= 3) {
				year.style.border = "1px solid silver";
				year_error.style.display = "none";
				return true;
			}
		}

		function cvv_Verify() {
			if (cvv.value.length >= 3) {
				cvv.style.border = "1px solid silver";
				cvv_error.style.display = "none";
				return true;
			}
		}
	</script>
</body>

</html>