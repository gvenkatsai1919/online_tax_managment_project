<?php
require 'clean.php';
session_start();
if(isset($_POST['submit'])){
	$conn=new mysqli("localhost","root","","onlinetaxmanagementsystem");
	$reg_id=$_SESSION['reg_id'];
	$schedule_date=clean($_POST['date']);
	// echo $schedule_date;
	$schedule_id=substr($schedule_date,0,4).substr($schedule_date,5,2).substr($schedule_date,8,2)."01";
	// echo $schedule_id;
	if($conn->connect_error){
        die("connection didn't established");
	}
	$sql="insert into schedule values('$schedule_id','$reg_id','$schedule_date','130822');";
	if($conn->query($sql)==TRUE){
?>
		<script>
			alert("The interview has been scheduled!!");
		</script> 
<?php
	}
	else{
?>
		<script>
			alert("Schedules are busy!!\nYour interview has not been scheduled.\nPlease pick any other slot.");
		</script>
<?php
	}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Schedule</title>
	<link rel="stylesheet" href="style.css">
	<!-- Font -->
	<style>
		body {
			/* font-weight: 400; */
			color: #ddd;
			letter-spacing: 1px;
		}

		.container {
			background-color: #fafafa;
			margin: 150px;
			box-shadow: 10px 15px 20px rgba(0, 0, 0, .6);
			display: grid;
			border-radius: 10px;
			grid-template-columns: 40% 60%;
		}

		.container-time {
			background-color: #130f40;
			padding: 50px;
			outline: 3px dashed #998100;
			outline-offset: -30px;
			border-radius: 10px;
			text-align: center;
		}

		.heading {
			font-size: 35px;
			text-transform: uppercase;
		}

		.heading-days {
			color: #998100;
			font-size: 30px;
		}

		.heading-phone {
			font-size: 20px;
		}

		.container-form {
			padding: 20px 0;
			margin: 0 auto;
			color: #000;
		}

		form {
			display: grid;
			grid-row-gap: 20px;
		}

		form p {
			font-weight: 600;
		}

		.form-field {
			display: flex;
			justify-content: space-between;
			margin: 15px;
		}

		input,
		select {
			padding: 10px 15px;
		}

		button {
			width: 30%;
			height: 40px;
			margin: 30px auto;
			justify-content: center;
			display: block;
			color: #ddd;
			background: #130f40;
			outline: none;
			border: none;
			border-radius: 5px;
			transition: .2s ease-in;
			cursor: pointer;
		}
	</style>
</head>

<body>
	<?php include 'navBar.php';?>
	<div class="container">
		<div class="container-time">
			<h2 class="heading">In Person Interview </h2>
			<h3 class="heading-days">Monday-Friday</h3>
			<p>9am - 1pm </p>
			<p>2pm - 5pm </p>

			<h3 class="heading-days">Saturday</h3>
			<p>9am - 1am </p>
			<h3 class="heading-days">Venue</h3>
			<p>Income Tax Towers,<br>
				Masab Tank,Hyderabad </p>
			<hr>
			<h4 class="heading-phone">Call Us:000-111-222</h4>
		</div>

		<div class="container-form">
			<form action="schedule.php" method="POST">
				<h2 class="heading heading-yellow">Online Interview</h2>

				<div class="form-field">
					<p>Your Name</p>
					<input name="name" type="text" placeholder="Your Name">
				</div>
				<div class="form-field">
					<p>Your email</p>
					<input name="email" type="email" placeholder="Your email">
				</div>
				<div class="form-field">
					<p>Date</p>
					<input name="date" type="date">
				</div>
				<!-- <div class="form-field">
					<p>Time</p>
					<input type="time">
				</div> -->
				<div class="form-field">
					<p>What is major aspect <br> to attend the interview?</p>
					<select name="select" id="#">
						<option value="1">On Computation of Tax</option>
						<option value="2">For Senior Citizens</option>
						<option value="3">On e-Filing and Related Issues</option>
						<option value="4">Payments</option>

					</select>
				</div>
				<button name="submit" onclick="myFunction()">Submit</button>
				<p id="Conform*"></p>
				<script>
					function myFunction() {
						var txt;
						var r = confirm("Press ok to conform the schedule");
						if (r == true) {
							txt = "Your Interview has been Scheduled ";
						} else {
							txt = "Your Interview has been cancelled ";
						}
						document.getElementById("Conform*").innerHTML = txt;
					}
				</script>

			</form>
		</div>
	</div>


</body>

</html>