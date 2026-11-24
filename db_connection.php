<?php 

$Servername = "Localhost";
$Username = "root";
$Password = "";
$DBname = "login_system";


// Create Connection
$conn = mysqli_connect($Servername,$Username,$Password,$DBname);

if(!$conn)
    {
        die("فشل عمليه الاتصال ".mysqli_connect_error());
    }



?>