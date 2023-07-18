<?php

$conn=new mysqli("localhost","root","","onlinetaxmanagementsystem");
$sql="select fname from client;";
$get_user = mysqli_query($conn, $sql);
while (($names = mysqli_fetch_assoc($get_user))!=null) {
    echo $names['fname'];
}
?>