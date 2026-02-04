
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
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
            margin-bottom:10px;
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
    <!-- php code started -->
    
    <?php
    $conn = mysqli_connect('localhost','root','','class_tutorial');
    if(isset($_GET['id']))
    {
    $id = $_GET['id'];
    $update = "select * from student where ROLL='$id'";
    $query = mysqli_query($conn,$update);
    if($query)
    {
        $item = mysqli_fetch_assoc($query);
    ?>

    <div class="container" id="dialog">
        <h2 style="text-align: center;">update student record</h2>
        <form method="post">
            <input type="number" name="roll" value="<?php echo $item['ROLL'];?>" placeholder="enter roll no" readonly>
            <input type="number" name="id" value="<?php echo $item['ID'];?>" placeholder="student id">
            <input type="text" name="name" value="<?php echo $item['NAME'];?>" placeholder="student name">
            <input type="number" name="mob" value="<?php echo $item['MOBILE'];?>" placeholder="enter mob number">
            <input type="email" name="email" value="<?php echo $item['EMAIL'];?>" placeholder="enter your email">
            <select name="city">
                <option><?php echo $item['CITY'];?></option>
                <option>gaya</option>
                <option>patna</option>
                <option>delhi</option>
                <option>jahanabad</option>
                <option>aurangabad</option>
                <option>nawada</option>
                <option>purniya</option>
            </select>
            <Select name="course">
                <option><?php echo $item['COURSE'];?></option>
                <option>B.tech</option>
                <option>Bsc.it</option>
                <option>BCA</option>
                <option>BBA</option>
                <option>BBM</option>
                <option>MCA</option>
                <option>M.tech</option>
            </Select><br>

            <button class="submit"name="update">UPDATE</button>
        </form>

    <?php
    if(isset($_POST['update']))
    {
        $name = $_POST['name'];
        $roll = $_POST['roll'];
        $sid = $_POST['id'];
        $mob = $_POST['mob'];
        $email = $_POST['email'];
        $city =$_POST['city'];
        $course = $_POST['course'];
        
        // $sql = "select * from student where ROLL ='$roll' AND ID='$sid' ";
        // $result = mysqli_query($conn,$sql);
        // if((mysqli_num_rows($result)))
        // {
        
        // }
        // else
        // {
            $update = "update student set NAME ='$name' , ROLL=$roll , ID= $sid , MOBILE=$mob ,EMAIL = '$email' , CITY='$city' , COURSE='$course' where ROLL=$id";
            $query = mysqli_query($conn,$update);
            if($query)
            {
                header("location:index.php");
            }
            else
            {
                echo "something went wrong";
            }
        // }
    }
    }
}
    ?>
</div>
</body>
</html>