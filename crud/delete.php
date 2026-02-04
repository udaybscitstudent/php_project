<?php

$conn = mysqli_connect("localhost", "root","" ,"crud");
if(isset($_GET['ROLL'])){
    $roll = $_GET['ROLL'];
    $query = "delete from registration where ROLL = $roll";
   $res = mysqli_query($conn, $query);
   if($res){
    header("Location: show.php");
}
}
?>