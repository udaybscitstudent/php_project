<?php
$conn = mysqli_connect('localhost','root','','class_tutorial');
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    
    $del = "delete from student where ROLL = '$id' ";
    $query = mysqli_query($conn,$del);
    if($query)
    {
        header("location:index.php"); 
    }
    else{
        echo "something is wrong";
    }
}
?>