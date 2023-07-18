<?php
require 'clean.php';

$reg_id=$user=$password='';

if(isset($_POST['submit'])){
    $reg_id=clean($_POST['reg_id']);
    $user=clean($_POST['username']);
    $password=clean($_POST['password']);

    $conn=new mysqli("localhost","root","","onlinetaxmanagementsystem");
    if($conn->connect_error){
        die("connection didn't established");
    }
    $sql="insert into client(reg_id,client_uid,client_pwd) values('$reg_id','$user','$password');";
    if($conn->query($sql)==TRUE){?>
        <script type="text/javascript">
        alert("Your account has been created, please login");
        window.open('login.php', '_self');
        </script> 
    <?php

    }
    else{?>
        <script type="text/javascript">
        alert("PAN number or User ID already exists!!");
        </script>
        <?php
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #formBox{
            width: 400px;
            height: 650px;
            margin: 50px auto;
            align-items: center;
            padding: 8px;
            border: 1px solid black;
            background: #fff;
            backdrop-filter: blur(8px);  
            border-radius: 20px;
            box-shadow: 5px 20px 50px #000;
        }
        #header{
            text-align: center;
            color: #130f40;
            font-weight: bolder;
            font-size: 30px;
            /* text-shadow: 4px 2px 2px rgb(56, 49, 49); */
        }

        #Details,#loginAcct,#CreateAcct{
            text-align: center;
        }

        #leftAllign{
            font-family: 'Courier New', Courier, monospace;
            font-size: 20px;
            font-weight: 600;
        }

        .rightAllign{
            width: 100%;
            padding: 5px 0;
            margin: 5px 0;
            border-left: 0;
            border-top: 0;
            border-right: 0;
            border-bottom: 1px solid #999;
            background: transparent;
        }

        #Acct{
            color: red;
        }

        #Cbutton,#lbutton{
            text-align: center;
            width: 75%;
            padding: 10px 30px;
            /* cursor: pointer; */
            display: block;
            /* margin: 0px auto; */
            background: #130f40;
            /* justify-content: center; */
        }
        button{
            width: 30%;
            height: 40px;
            margin: 0px auto;
            justify-content: center;
            display: block;
            color: #ddd;
            outline: none;
            border: none;
            border-radius: 5px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        #Cbutton:hover, #lbutton:hover{
            background: #130f40aa;
            color: #fff;
        }
    </style>
    <script>
        function validate(){
            var pancardid = document.getElementById("pannumber");
            var usernameid = document.getElementById("username");
            var passwordid = document.getElementById("password");
            var repasswordid = document.getElementById("repassword");
            var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
            var pstr = passwordid.value.trim();
            var pantr = pancardid.value.trim();
            if(pancardid.value.trim()==""){
                window.alert("Blank Pancard Number");
                return false;
            }
            else if(usernameid.value.trim()==""){
                window.alert("Blank Username");
                return false;
            }
            else if(passwordid.value.trim()==""){
                window.alert("Blank Password");
                return false;                
            }
            else if(repasswordid.value.trim()==""){
                window.alert("Blank Re-enter Password");
                return false;
            }
            else if(passwordid.value.trim()!=repasswordid.value.trim()){
                window.alert("Password Doesn't match");
                return false;
            }
            else if(pantr.length!=10){
                window.alert("Invalid Pancard Number");
                return false;
            }
            else if(pstr.length<5){
                window.alert("Password is very weak");
                return false;
            }            
            else if(!regpan.test(pantr)){                
                window.alert("Invalid Pancard Number");
                return false;
            } 
        }
    </script>
</head>
<body>
    <div id="formBox">
        <form action="register.php" method="POST" onsubmit="return validate()">
            <div id="header">
                <p>Registration</p>                
            </div>
            <div id="Details">
                <div id="pancard">
                    <p id="leftAllign">Pancard Number</p>
                    <input name="reg_id" type="text" class="rightAllign" id="pannumber" placeholder="Pancard Number">
                </div>
                <div id="userasd">
                    <p id="leftAllign">Username</p>
                    <input name="username" type="text" class="rightAllign" id="username" placeholder="Username">
                </div>
                <div id="passwordaas">
                    <p id="leftAllign">Password</p>
                    <input name="password" type="password" class="rightAllign" id="password" placeholder="Password">
                </div>
                <div id="repasswordaas">
                    <p id="leftAllign">Re-enter Password</p>
                    <input type="password" class="rightAllign" id="repassword" placeholder="Re-enter Password">
                </div>
                <br>
            </div>
            <div id="CreateAcct">
                <button name="submit" type="submit" id="Cbutton">Create Account</button>
            </div>                        
        </form>
        <hr>
        <form action="login.php">
            <div id="loginAcct">
                <p id="Acct">*If hava a Account</p>
                <button type="submit" id="lbutton">Login</button>
            </div>            
        </form>
    </div>        
</body>
</html>