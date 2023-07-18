<?php
require 'clean.php';
$tax=null;
session_start();
if(isset($_POST['submit'])){
	$reg_id=$_SESSION['reg_id'];
	$_SESSION['total']=$_POST['total'];
	$_SESSION['deductions']=$_POST['deductions'];

	$amount=$_POST['total']-$_POST['deductions'];
	$tax=0;
	if ($amount > 1500000) $tax = ($amount - 1500000) * .30 + (250000) * .75;
	else if ($amount > 1250000) $tax = ($amount - 1250000) * .25 + (250000) * .5;
	else if ($amount > 1000000) $tax = ($amount - 1000000) * .20 + (250000) * .3;
	else if ($amount > 750000) $tax = ($amount - 750000) * .15 + (250000) * .15;
	else if ($amount > 500000) $tax = ($amount - 500000) * .10 + (250000) * .05;
	else $tax = $amount * .05;
	$_SESSION['tax']=$tax; 
}
if((isset($_POST['card']) || isset($_POST['netbanking'])) && $_SESSION['total']-$_SESSION['deductions']>0){
	$conn=new mysqli("localhost","root","","onlinetaxmanagementsystem");
	$reg_id=$_SESSION['reg_id'];
	$pay_date=clean(date("Y-m-d"));
	$total=$_SESSION['total'];
	$deductions=$_SESSION['deductions'];
	$pay_id=random_int(100000, 999999);
	$_SESSION['pay_id']=$pay_id;
	while(mysqli_fetch_array($conn->query("select pay_id from payment where pay_id='pay_id'"))!=NULL) $pay_id=random_int(100000, 999999);
	if($conn->connect_error){
        die("connection didn't established");
    }
    $sql="insert into payment values('$pay_id','$reg_id','$pay_date','fail','$total','$deductions');";
    if($conn->query($sql)==TRUE){
		if(isset($_POST['card'])){
?>
			<script type="text/javascript">
				alert("You will be directed to payment portal");
				window.open('card.php', '_self');
			</script>
<?php
		}
		else{
?>
			<script type="text/javascript">
				alert("You will be directed to payment portal");
				window.open('netbanking.php', '_self');
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


?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Payment</title>
	<link rel="stylesheet" href="style.css">
	<style>
		article,aside,figure,footer,header,nav,section {
			display: block;
		}
		table {
			float: left;
			border-spacing: 1;
			border-collapse: collapse;
			background: #ddd;
			border-radius: 6px;
			overflow: hidden;
			width: 600px;
			margin: 20px 8%;
			position: relative;
		}

		thead {
			height: 60px;
			color: white;
			background: #130f40;
		}

		td,
		th {
			text-align: left;
			padding: 8px;
			font-size: 12px;
		}

		tr {
			height: 36px;
			border-bottom: 1px solid #E3F1D5;
		}

		tr:last-child {
			border: 0;
		}

		h1 {
			text-align: center;
			color: #130f40;
			margin-top: 60px;
		}

		.main {
			float: left;
			width: 350px;
			height: 500px;
			overflow: hidden;
			border-radius: 10px;
			box-shadow: 5px 20px 50px #000;
			background-color: white;
			margin: 100px 8%;
		}

		#chk {
			display: none;
		}

		.calculator {
			position: relative;
			width: 100%;
			height: 100%;
		}

		label {
			color: #130f40;
			font-size: 2.3em;
			justify-content: center;
			display: flex;
			margin: 60px;
			font-weight: bold;
			cursor: pointer;
			transition: .5s ease-in-out;
		}

		input {
			width: 60%;
			height: 20px;
			background: #ddd;
			justify-content: center;
			display: flex;
			margin: 20px auto;
			padding: 10px;
			border: none;
			outline: none;
			border-radius: 5px;
		}

		button {
			width: 60%;
			height: 40px;
			margin: 10px auto;
			justify-content: center;
			display: block;
			color: #130f40;
			background: #ddd;
			margin-top: 20px;
			outline: none;
			border: none;
			border-radius: 5px;
			transition: .2s ease-in;
			cursor: pointer;
		}

		button:hover {
			background: #aaa;
		}

		.payment {
			height: 460px;
			background: #130f40;
			border-radius: 60% / 10%;
			transform: translateY(-200px);
			transition: .8s ease-in-out;
		}

		.payment label {
			color: #ddd;
			transform: scale(.6);
		}

		#chk:checked~.payment {
			transform: translateY(-500px);
		}

		#chk:checked~.payment label {
			transform: scale(1);
		}

		#chk:checked~.calculator label {
			transform: scale(.6);
		}
	</style>
</head>

<body>
	<?php include 'navBar.php';?>

	<div class="main">
		<input type="checkbox" id="chk" aria-hidden="true">
		<div class="calculator">
			<form action="payment.php" method="POST">
			<label for="chk" aria-hidden="true">Tax Calculator</label>
			<input name="total" type="text" id="income" placeholder="Total Payable Tax" required="">
			<input name="deductions" type="text" id="deductions" placeholder="Deductions" required="">
			<button name="submit" id="calculate" style="color: #ddd; background: #130f40;">Calculate</button>
			</form>
		</div>
		
		<div class="payment">
			<form action="payment.php" method="POST">
			<label for="chk" class="tax" aria-hidden="true">Pay <?php if($tax>0 ) echo $tax;?></label>
			<button name="card" class="button" >Debit Card/Credit Card</button>
			<button name="netbanking" class="button" onclick="location.href='netbanking.html'">Netbanking</button>
			</form>	
		</div>
	</div>
	<table>
		<h1> Slabs</h1>
		<colgroup>
			<col style="width: 20%;">
			<col style="width: 40%;">
			<col style="width: 15%;">
		</colgroup>
		<thead>
			<th>Taxable Income</th>
			<th>Tax Percentage</th>
			<th>Minimum Income Tax Payable</th>
		</thead>
		<tr>
			<td>Up to Rs 2,50,000</td>
			<td>5%</td>
			<td>0</td>
		</tr>
		<tr>
			<td>Rs 2,50,000 to Rs 5,00,000</td>
			<td>5% (5% of Rs 5,00,000 less Rs 2,50,000)</td>
			<td>12,500</td>
		</tr>
		<tr>
			<td>Rs 5,00,000 to Rs 7,50,000</td>
			<td>10% (10% of Rs 7,50,000 less Rs 5,00,000)</td>
			<td>25,000</td>
		</tr>
		<tr>
			<td>Rs 7,50,000 to Rs 10,00,000</td>
			<td>15% (15% of Rs 10,00,000 less Rs 7,50,000)</td>
			<td>37,500</td>
		</tr>
		<tr>
			<td>Rs 10,00,000 to Rs 12,50,000</td>
			<td>20% (20% of Rs 12,50,000 less Rs 10,00,000)</td>
			<td>50,000</td>
		</tr>
		<tr>
			<td>Rs 12,50,000 to Rs 15,00,000</td>
			<td>25% (25% of Rs 15,00,000 less Rs 12,50,000)</td>
			<td>62,500</td>
		</tr>
		<tr>
			<td>More than Rs Rs 15,00,000</td>
			<td>30% (30% of Rs 20,92,000 less Rs 15,00,000)</td>
			<td>1,77,600</td>
		</tr>
	</table><br>
</body>

</html>