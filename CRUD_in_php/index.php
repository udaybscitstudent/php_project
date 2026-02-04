<html>
    <head>
        <title>CRUD applicaton</title>
<style>
    body{
        height:100%;
        width:80%;
        margin:auto;
        
    }
    tr,th,td{
        height:50px;
        width:12%;
        text-align:center;
        border:none;
        border:1px grey solid;
    }
    th{
        background-color:darkgrey;
        position:sticky;
        border:1px black solid;
        top:0;
    }
    table{
        margin-top:20px;
        width:100%;
        border-collapse:collapse;
        /* position:absolute; */
    }
    h2{
        display:inline-block;
    }
    .action a{
    font-size:15px;
    color: white;
    background-color:blue; 
    width:55px;
    height:32px;
    line-height:30px;
    border-radius: 5px;
    text-decoration: none;
    display:inline-block;
}
td a{
    text-decoration:none;
    display:inline-block;
    height:50px;
    width:200px;
    /* background:blue; */
    line-height:50px;
    /* color:white; */
    cursor: pointer;
    border-radius:10px;
}
.container{
    height:300px;
    width:300px;
    text-align:center;
    border:1px grey solid;
    position:absolute;
    z-index:1;
    background-color:grey;
    margin:100px 30%;
    display:none;
}
.open{
    display:auto;
}
</style>
</head>
<body>
<table align="Center">
    <tr bgcolor="skyblue">
        <td colspan="8"><h2><a href="insert.php"> ADD STUDENT</a></h2></td>
    </tr>
    <tr> 
        <th>ROLL</th>
        <th>ID</th>
        <th>NAME</th>
        <th>MOBILE</th>
        <th>EMAIL</th>
        <th>CITY</th>
        <th>COURSE</th>
        <th>ACTION</th>
    </tr>
<?php
$conn = mysqli_connect('localhost','root','','class_tutorial');
$query = "select * from student ORDER BY ROLL";
    $data = mysqli_query($conn,$query);
    if(mysqli_num_rows($data))
    {
        foreach($data as $item)
        {
            ?>
            <tr>
            <td><?php echo $item['ROLL'];?></td>
            <td><?php echo $item['ID'];?></td>
            <td><?php echo $item['NAME'];?></td>
            <td><?php echo $item['MOBILE'];?></td>
            <td><?php echo $item['EMAIL'];?></td>
            <td><?php echo $item['CITY'];?></td>
            <td><?php echo $item['COURSE'];?></td>
            <td class="action">
            <a href="update.php?id=<?php echo $item['ROLL'];?>" onclick="checkupdate()" style="background:green;">update</a>
            <a href="#" onclick="checkdelete(<?php echo $item['ROLL'];?>)" style="background:red;">delete</a>
            <!-- <a href="delete.php?id=<?php echo $item['ROLL'];?>" style="background:red;">Delete</a> -->
            </td>
        </tr>
            <?php
        }
    }
?>
<div class="container">
    <img src="image.png" height="100px">
    <h2>are you sure you want to delete</h2>
    <button>delete</button>
</table>

</div>
<script>
    function checkdelete(roll)
    {
        let x = window.confirm("Are you sure you want to delete roll = "+roll);
        if(x==true){
            window.location="delete.php?id="+roll;
        }
    }
</script>
</body>
</html>
