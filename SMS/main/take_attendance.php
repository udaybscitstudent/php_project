<?php 
include 'checklogin.php';
include 'header.php'; 
include 'conn.php';
?>
<!-- <div class="h-[85vh] bg-white rounded shadow-lg w-[90%] m-auto mt-8 py-5"> -->
    <select class="border bg-gray-100 appearance-none border-gray-500 rounded-full mb-5 mx-auto block px-3 py-2 w-[50%] outline-gray-500 course">
            <option value="" class="text-center"><?php echo (isset($_GET['course'])) ? " Selected Course : ".$_GET['course'] : "------- Select Course -------"; ?></option>
            <option value="BA">BA</option>
            <option value="BSC">BSC</option>
            <option value="BCA">BCA</option>
            <option value="BSC.it">BSC.it</option>
            <option value="BBA">BBA</option>
            <option value="B.tech">B.tech</option>
            <!-- <option value="ALL">All</option> -->
        </select>
        <script>
            document.querySelector(".course").addEventListener("change", function () {
                let selectedCourse = this.value;
                window.location.href = "take_attendance.php?course=" + selectedCourse;
            });
            </script>
        <?php
            if(isset($_GET['course'])) {
                $course = $_GET['course'] ?? '';
                $query = "select * from students where COURSE = '$course' order by ROLL";
                $res = mysqli_query($conn, $query);
            ?>
<div class="h-[70vh] overflow-y-auto">
    <table class="mx-auto w-[90%] text-center">
        <tr class="bg-gray-500 p-3 text-white sticky top-0">
            <th class="p-3 border border-t-0 border-gray-500">SI.No</th>
            <th class="p-3 border border-t-0 border-gray-500">Roll No</th>
            <th class="p-3 border border-t-0 border-gray-500">Name</th>
            <!-- <th class="p-3 border border-t-0 border-gray-500">Total Classes</th> -->
            <!-- <th class="p-3 border border-t-0 border-gray-500">Total Present</th> -->
            <!-- <th class="p-3 border border-t-0 border-gray-500">Total Absent</th> -->
            <th class="p-3 border border-t-0 border-gray-500">Attendance %</th>
            <th class="p-3 border border-t-0 border-gray-500">Mark Attendance</th>
        </tr>
        <?php
            
            $date = date("Y-m-d"); 
            if(mysqli_num_rows($res) == 0){
                echo "<tr><td colspan='5' class='p-5 text-center'>No students found for the selected course.</td></tr>";
            }

            $check_att = "select a.DATE , s.COURSE from attendance as a join students as s ON a.S_ID = s.ID where s.COURSE = '$course' AND DATE(a.DATE) = '$date'";
            $check_query = mysqli_query($conn , $check_att);
            if(mysqli_num_rows($check_query)>0){
                ?>
                <div class="bg-red-100 text-red-700 p-3 rounded w-[90%] mx-auto my-2 text-center" id="alertBox">
                    Attendance for the course <strong><?php echo $course; ?></strong> has already been taken today (<?php echo $date; ?>).
                </div>
                <script>
                setTimeout(() => {
                    document.getElementById("alertBox")?.classList.add("hidden");
                }, 10000);
                </script>

                <?php

            }
            $i=1;
            while($row = mysqli_fetch_assoc($res)){
                $check = "select * from attendance where DATE(DATE) = '$date' and S_ID = ".$row['ID'];
                $checkres = mysqli_query($conn , $check);
                $att_row = mysqli_num_rows($checkres);
                $status = mysqli_fetch_assoc($checkres);

                // count the total class of a particular student
                $count = "select COUNT(*) as total from attendance where S_ID = ".$row['ID'];
                $count_p = "select COUNT(*) as present from attendance where attendance = 'P' and S_ID = ".$row['ID'];
                // $count_a = "select COUNT(*) as absent from attendance where attendance = 'A' and S_ID = ".$row['ID'];

                $countres = mysqli_query($conn , $count);
                $countrow = mysqli_fetch_assoc($countres);

                $countpres = mysqli_query($conn , $count_p);
                $countprow = mysqli_fetch_assoc($countpres);

                // $countabs = mysqli_query($conn , $count_a);
                // $countarow = mysqli_fetch_assoc($countabs);

                ?>
                <tr>
                    <td class='border border-gray-500 p-3'><?php echo $i++; ?></td>
                    <td class='border border-gray-500 p-3'><?php echo $row['ROLL'];?></td>
                    <td class='border border-gray-500 p-3'><?php echo $row['NAME'];?></td>
                    <td class='border border-gray-500 p-3'><?php echo ($countrow['total'] > 0) ? round(($countprow['present'] / $countrow['total']) * 100, 2) : 0; ?>%</td>
                    <td class='border border-gray-500 p-3'>
                        <form method="post">
                            <div class="flex flex-row justify-center items-center gap-3">
                                <input type='radio' class="peer/present hidden" id="present<?php echo $row['ID'];?>" name='attendance[<?php echo $row['ID'];?>]' value='P' <?php echo ($att_row > 0 && $status['ATTENDANCE'] =='P') ? "checked" : ""; ?>> 
                                <label for="present<?php echo $row['ID'];?>" class="border px-2.5 py-1 peer-checked/present:bg-green-500 peer-checked/present:text-white transition rounded">Present</label>
                                <input type='radio' class="peer/absent hidden" id="absent<?php echo $row['ID'];?>" name='attendance[<?php echo $row['ID'];?>]' value='A' <?php echo ($att_row > 0 && $status['ATTENDANCE'] =='A') ? "checked" : ""; ?>>
                                <label for="absent<?php echo $row['ID'];?>" class="border  px-2.5 py-1 peer-checked/absent:bg-red-500 peer-checked/absent:text-white rounded">Absent</label>
                            </div>
                    </td>
                </tr>
                <?php
            }
            
            ?>   
                <tr>
                    <td class="my-5 "colspan="7" align="left">
                        <button type="submit" name="take_attendance" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 my-5 rounded px-10">Submit Attendance</button></td>
                </tr>
            </form>
    </table>
<?php include 'footer.php'; ?>

<?php
if(isset($_POST['take_attendance'])) { 
    $attendance = $_POST['attendance'];
    foreach($attendance as $id => $status) {
        if($att_row) {
                $sql = "UPDATE attendance SET ATTENDANCE = '$status' WHERE S_ID = '$id' AND DATE(DATE) = '$date'";
                $update = true;
            } else {
                $sql = "INSERT INTO attendance (S_ID, ATTENDANCE) VALUES ('$id', '$status')";
                $insert = true;
        }
        if ($conn->query($sql) === TRUE) {
            $flag=true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }   
    }
    if($flag && $insert) {
        echo "<script>alert('Attendance taken successfully');</script>";
    }
    if($flag && $update) {
        echo "<script>alert('Attendance updated successfully');</script>";
    }
}


?>
</div>
<?php
            } else {
                echo "<div class='h-[70vh] flex place-items-center justify-center'><h1 class='text-xl font-bold'>Please select a course to take attendance.</h1></div>";
            }
            ?>
     
</div>