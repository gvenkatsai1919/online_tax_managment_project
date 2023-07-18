<?php
require 'clean.php';
session_start();
$conn=new mysqli("localhost","root","","onlinetaxmanagementsystem");
$reg_id=$_SESSION['reg_id'];
$sql="select * from client where reg_id='$reg_id'";
$select=$conn->query($sql);
if($select==TRUE && $select->num_rows>0){
    $result=mysqli_fetch_assoc($conn->query($sql));
    $old_fname=$result['fname'];
    $old_lname=$result['lname'];
    $old_email=$result['email'];
    $old_gender=$result['gender'];
    $old_dob=$result['dob'];
    $old_city=$result['city'];
    // echo $old_fname;
    // echo $old_lname;
    // echo $old_email;
    // echo $old_gender;
    // echo $old_dob;
    // echo $old_city;

}
else{
    $old_fname="";
    $old_lname="";
    $old_email="";
    $old_gender="";
    $old_dob="";
    $old_city="";
}
$sql="select phone_no from phone where reg_id='$reg_id'";
$select=$conn->query($sql);
if($select==TRUE && $select->num_rows>0){
    $result=mysqli_fetch_array($conn->query($sql));
    $old_phone=$result[0];
    // echo $old_phone;
}
else{
    $old_phone="";
}

$sql="select * from city where city='$old_city'";
$select=$conn->query($sql);
if($select==TRUE && $select->num_rows>0){
    $result=mysqli_fetch_array($conn->query($sql));
    $old_state=$result['state'];
    $old_zip=$result['zip'];
    // echo $old_state;
    // echo $old_zip;
}
else{
    $old_state="";
    $old_zip="";
}

if(isset($_POST['submit'])){
    $fname=$lname=$gender=$phone=$email=$city=$state='';
    $pin=0;
    $reg_id=$_SESSION['reg_id'];
    $fname=clean($_POST['fname']);
    $lname=clean($_POST['lname']);
    $dob=clean($_POST['dob']);
    $gender=clean($_POST['gender']);
    $phone=clean($_POST['phno']);
    $email=clean($_POST['email']);
    $city=clean($_POST['city']);
    $state=clean($_POST['state']);
    $pin=clean($_POST['pin']);

    if($conn->connect_error){
        die("connection didn't established");
    }
    $sql="update client set fname='$fname', lname='$lname', dob='$dob', gender='$gender', email='$email', city='$city' where reg_id='$reg_id';";
    if($conn->query($sql)==TRUE){
        $sql="insert into phone values('$reg_id','$phone');";
        if($conn->query($sql)==TRUE){
            $sql="select city from city where city='$city';";
            $result = mysqli_fetch_array($sql);
            if($result==null){
                $sql="insert into city value('$city','$state','$pin');";
                if($conn->query($sql)==TRUE){
?>
                    <script>
                        alert("Details submitted!!");
                    </script>
<?php
                }
            }
            else{
?>
                <script>
                    alert("Details submitted!!");
                </script>
<?php
            }

        }
        else{
?>
            <script>
                alert("Details submitted!!");
            </script>
<?php
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Application</title>
    <style>
        #formApplication{
            width: 500px;
            height: 600px;
            justify-content: center;
            align-items: center;
            border-radius: 20px;
            margin: 50px auto;
            box-shadow: 5px 20px 50px #000;
            background-color: white;
            padding: 10px;
        }

        #header{
            text-align: center;
            font-size: 30px;
            color: #130f40;
        }

        #survey-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }

        .alignright {
            text-align: right;
        }
        .cw,.ce,.ca{
            width: 175px;
            border: 0;
            border-bottom: 1px solid #999;
        }
        .ce{
            width: 150px;
        }
        .ca{
            width: 150px;        
        }

        .ph{
            display: grid;
            grid-template-columns: 0fr 1fr;
            grid-gap: 1px;
        }

        .addr{
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 20px;
        }
        /* .submitButton,.resetButton{
            text-align: center;
            width: 30%;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            font-weight: bold;
            margin: auto;            
            background-origin: 0;
            border-radius: 30px;
        } */
        button{
            width: 30%;
            height: 40px;
            margin: 0px auto;
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
    <script>
        function validation(){
            var firnameid = document.getElementById("fname");
            var lnameid = document.getElementById("lname");            
            var phnoid = document.getElementById("phno");
            var cityid = document.getElementById("City");
            var stateid = document.getElementById("State");
            var Pincodeid = document.getElementById("Pincode");
            let dateid = new Date(document.getElementById("dob").value);

            var pinee = Pincodeid.value.trim();
            var pstree = phnoid.value.trim();
            // window.alert(pinee.length);
            // window.alert(pstree.length);
            var numpin = pinee.length;
            var numpho = pstree.length;

            var emailID = document.myform.email.value; 
            atpos = emailID.indexOf("@"); 
            dotpos = emailID.lastIndexOf("."); 
            if (atpos < 1 || ( (dotpos - atpos) < 2 )) { 
                alert("Please enter correct email ID") ;
                return false;
            }             
            else if(firnameid.value.trim()==""){
                window.alert("Blank First name");
                return false;
            }
            else if(lnameid.value.trim()==""){
                window.alert("Blank Last name");
                return false;
            }
            else if(phnoid.value.trim()==""){
                window.alert("Blank Phone Number");
                return false;
            }
            else if(numpho!=10){
                window.alert("Enter correct Phone Number");
                return false;
            }
            else if(dateid==""){
                window.alert("Enter Date of birthday");
                return false;
            }
            else if(cityid.value.trim()==""){
                window.alert("Blank City");
                return false;
            }
            else if(stateid.value.trim()==""){
                window.alert("Blank State");
                return false;
            }
            else if(Pincodeid.value.trim()==""){
                window.alert("Blank Pincode");
                return false;
            }
            else if(numpin!=6)            {
                window.alert("Enter Correct Pincode");
                return false;
            }
        }
    </script>
</head>
<body>
    <?php include 'navBar.php';?>
    <div id="formApplication">
        <h1 id="header">        
            <p>Application Form</p>
        </h1>        
        <div id="formDesign">
            <form name="myform" action="application.php" method="POST" onsubmit="return validation()">                              
                <div id="survey-form">
                    <label class="alignright" for="fname"><span style="color: red;">*</span>First Name : </label>
                    <input type="text" name="fname" class="cw" id="fname" value="<?php echo $old_fname;?>"> 

                    <label class="alignright" for="lname"><span style="color: red;">*</span>Last Name : </label>
                    <input type="text" name="lname" class="cw" id="lname" value="<?php echo $old_lname;?>">  
                    
                    <label class="alignright" for="email"><span style="color: red;">*</span>Email : </label>
                    <input type="text" name="email" class="cw" id="email" value="<?php echo $old_email;?>">
                    
                    <label class="alignright" for="phno"><span style="color: red;">*</span>Phone Number : </label>
                    <div class="ph">              
                        <label for="phno" class="alignright">+91-</label>            
                        <input type="text" name="phno" class="ce" id="phno" value="<?php echo $old_phone;?>">                        
                    </div> 
                    
                    <label class="alignright" for="gender"><span style="color: red;">*</span>Gender : </label>
                    <div>
                    <?php
                        if($old_gender=="male"){
                    ?>
                        <label for="male">
                            <input  type="radio" name="gender" value="male" checked required> Male
                        </label> 
                        <label for="female">
                            <input type="radio" name="gender" value="female" required> Female
                        </label><br>
                    <?php
                        }
                        else{
                    ?>
                        <label for="male">
                            <input  type="radio" name="gender" value="male" required> Male
                        </label> 
                        <label for="female">
                            <input type="radio" name="gender" value="female" checked required> Female
                        </label><br>
                    <?php
                        }
                    ?>
                    </div>

                    <label class="alignright" for="dob"><span style="color: red;">*</span>Date of birth : </label>
                    <input type="date" name="dob" class="cw" value="<?php echo $old_dob;?>" id="dob" required>

                    <label class="alignright" for="address"><span style="color: red;">*</span>Address : </label>
                    <div class="addr">    
                        <input type="text" name="city" class="ca" id="City" value="<?php echo $old_city;?>">
                        <input type="text" name="state" class="ca" id="State" value="<?php echo $old_state;?>">
                        <input type="text" name="pin" class="ca" id="Pincode" value="<?php echo $old_zip;?>">
                    </div>
                </div>
                <br>                
                <div class="addr">
                    <button name="submit" type="submit" class="submitButton">Submit</button>
                    <button type="reset" class="resetButton">Reset</button>
                </div>                
            </form>
        </div>
    </div>
</body>
</html>