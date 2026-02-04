<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body,html{
            margin:auto;
            height:100%;
            width:80%;
            display:flex;
            /* justify-content: center; */
            place-items: center;
        }
        .submit{
            height:50px;
            width:150px;
            border-radius:15px;
            border:1px grey solid;
        }
        input,select{
            height:40px;
            width:80%;
            margin-bottom: 10px;
            padding-left:10px;
            font-size:17px;
            border-radius:15px;
            border:1px grey solid;
            outline:none;
        }
        select{
            height:45px;
            width:81.6%;
        }
        .container{
            border-radius:20px;
            /* margin-top:20px; */
            width:100%;
            height:auto;
            text-align:center;
            border:1px grey solid;
        }
        
    </style>
</head>
<body>
    <div class="container" id="dialog">
        <h2 style="text-align: center;">Add new student</h2>
        <form method="post">
            <input type="text" name="name" placeholder="student name">
            <input type="number" name="roll" placeholder="enter roll no">
            <input type="number" name="id" placeholder="student id">
            <input type="number" name="mob" placeholder="enter mob number">
            <input type="email" name="email" placeholder="enter your email">
            <select name="city">
                <option>select your city</option>
                <option>gaya</option>
                <option>patna</option>
                <option>delhi</option>
                <option>jahanabad</option>
                <option>aurangabad</option>
                <option>nawada</option>
                <option>purniya</option>
            </select>
            <Select name="course">
                <option>select your course</option>
                <option>B.tech</option>
                <option>Bsc.it</option>
                <option>BCA</option>
                <option>BBA</option>
                <option>BBM</option>
                <option>MCA</option>
                <option>M.tech</option>
            </Select><br>
            <button class="submit"name="back">Back</button>
            <button class="submit"name="submit">Add student</button>
            <br>
            <br>
        </form>
    
<?php
$conn = mysqli_connect('localhost','root','','class_tutorial');
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $id = $_POST['id'];
    $mob = $_POST['mob'];
    $email = $_POST['email'];
    $city =$_POST['city'];
    $course = $_POST['course'];

    $query = "select * from student where ID=$id AND EMAIL='$email' ";
    $check = mysqli_query($conn,$query);
    $row = mysqli_num_rows($check);
    if($row)
    {
        ?><p style="font-size:20px;color:red;"><?php echo "All ready added this student please add new student"?></p><?php
    }
    else{
    $sql = "INSERT INTO `student` (`NAME`, `ROLL`, `ID`, `MOBILE`, `EMAIL`, `CITY`, `COURSE`) VALUES ('$name', '$roll', '$id', '$mob', '$email', '$city', '$course')";
    $result=mysqli_query($conn,$sql);
    if($result)
    {
        header("location:index.php");
    }
    else{
        echo "student not added";
    }
}
}
if(isset($_POST['back']))
{
header("location:index.php");
}
?>
</div>
</body>
</html>