<?php
require 'clean.php';

if(isset($_POST['submit'])){
  session_start();
  $conn = new mysqli("localhost","root","","onlinetaxmanagementsystem");
  if($conn->connect_error){
      die("connection didn't established");
  }
  $username = clean($_POST['username']);
  $password = clean($_POST['password']);

  $select_user = "select * from client where client_uid='$username' AND client_pwd='$password'";
  if($conn->query($select_user) == TRUE){
    $result = $conn->query($select_user);
    $check = $result->num_rows;

    if($check == 1){
      $_SESSION['client_uid'] = $username;
      $get_user = mysqli_query($conn, "select * from client where client_uid='$username'");
      $user_row = mysqli_fetch_array($get_user);
      $_SESSION['reg_id'] = $user_row['reg_id'];
      $session_user = $user_row['client_uid'];

      echo "<script> window.open('Home.php?user_name=$session_user', '_self')</script>";
    }
    else{?>
        <script type="text/javascript">
        alert('Invalid Credentials');
        </script>
        <?php
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #login{
            text-align: center;
            color: #130f40;
            font-weight: bold;
            font-size: 30px;
            /* text-shadow: 4px 2px 2px rgb(56, 49, 49); */
        }
        #formBox{
            width: 300px;
            height: 480px;
            margin-top: 50px;
            margin-left: 590px;
            align-items: center;
            padding: 8px;
            border: 1px solid black;
            background: #fff;
            backdrop-filter: blur(8px);  
            border-radius: 20px;
            box-shadow: 5px 20px 50px #000;
            
        }

        #dataTable{
            text-align: center;
            position: relative;
        }
        #leftAllign{
            font-family: 'Courier New', Courier, monospace;
            font-size: 20px;
            font-weight: 600;
            /* padding: 2px; */
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

        #Button,#rButton{
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

        #rButton:hover, #Button:hover{
            background: #130f40aa;
            color: #fff;
        }
        a:link {
            color: rgb(0, 0, 0);
            background-color: transparent;
            text-decoration: none;
        }
        a:visited{
            color: rgb(0, 0, 0);
            background-color: transparent;
            text-decoration: none;           
        }
        a:hover{
            color: rgb(0, 0, 0);
            background-color: transparent;
            text-decoration: none;
        }
        a:active{
            color: rgb(0, 0, 0);
            background-color: transparent;
            text-decoration: none;
        }
    </style>
    <script>
        function validation(){
            document.getElementById
            var user = document.getElementById("uname");
            let pwd = document.getElementById("password");
            var pstr = pwd.value.trim();
            if(user.value.trim()==""){
                window.alert("Blank Username");
                return false;
            }
            else if(pwd.value.trim()==""){
                window.alert("Blank Password")
                return false;
            }
            else if(pstr.length<5){
                document.getElementById("invalidPass").style.visibility="visible";
                return false;
            }
        }
    </script>
</head>
<body id="body">
    <div id="formBox">
        <form action="login.php" method="POST" onsubmit="return validation()">
            <div id="login">
                <p>LOGIN</p>
            </div>  
            <div id="dataTable">
                <div id="user">
                    <p id="leftAllign"><a href="#" title="Username" data-toggle="popover" data-trigger="hover" data-content="reg_id : ******">Username</a></p>
                    <input type="text" name="username" id="uname" class="rightAllign" placeholder="Username">
                </div>
                <br>
                <div id="pword">
                    <p id="leftAllign"><a href="#" title="Password" data-toggle="popover" data-trigger="hover" data-content="Password : Aabcd123@">Password</a></p>
                    <input type="password" name="password" id="password" class="rightAllign" placeholder="Password">
                    <p id="invalidPass" style="color: rgb(243, 49, 23); visibility: hidden;">*Incorrect Credential</p>                    
                </div> 
            </div> 
            <div>
                <button name="submit" type="submit" id="Button">Submit</button>
            </div>     
        </form>        
        <hr>
        <form action="register.php">
            <button type="submit" id="rButton">Register</button>
        </form>
    </div>
    <script>
        $(document).ready(function(){
          $('[data-toggle="popover"]').popover();   
        });
    </script>    
</body>
</html>