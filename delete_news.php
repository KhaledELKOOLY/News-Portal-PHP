<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == NULL)
    {
        header("location:login.php");
        exit();
    }

?>

<?php

require 'db_connection.php';

if($_GET['action'] == 'delete' && isset($_GET['id']))
    {
        $id = $_GET['id'];
        $query = "DELETE FROM news where id = '$id'; ";
        mysqli_query($conn,$query);
        header("location:index.php");
        exit();
    }
else
    {
        echo "Not Delete Successfully.";

    }
//mysqli_close($conn);



?>