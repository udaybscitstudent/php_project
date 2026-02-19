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
            <option value="ALL">All</option>
        </select>
        <script>
        document.querySelector(".course").addEventListener("change", function () {
            let selectedCourse = this.value;
            window.location.href = "show_attendance.php?course=" + selectedCourse;
        });
    </script>
<div class="h-[70vh] overflow-y-auto">
    <table class="mx-auto w-[90%] text-center">
        <tr class="bg-gray-500 p-3 text-white sticky top-0">
            <th class="p-3 border border-t-0 border-gray-500">SI.No</th>
            <th class="p-3 border border-t-0 border-gray-500">ID</th>
            <th class="p-3 border border-t-0 border-gray-500">Roll No</th>
            <th class="p-3 border border-t-0 border-gray-500">Name</th>
            <th class="p-3 border border-t-0 border-gray-500">Total Classes</th>
            <th class="p-3 border border-t-0 border-gray-500">Total Present</th>
            <th class="p-3 border border-t-0 border-gray-500">Total Absent</th>
            <th class="p-3 border border-t-0 border-gray-500">Attendance %</th>
        </tr>
        <?php

            if(isset($_GET['course'])) {
                $course = $_GET['course'];
                $query = "select distinct a.S_ID,s.ROLL ,s.NAME from attendance as a join students as s on a.S_ID = s.ID where s.COURSE = '$course' order by s.ROLL";

            }
            if((!isset($_GET['course'])) || $_GET['course'] == 'ALL')
                {
                    $query = "select distinct a.S_ID,s.ROLL ,s.NAME from attendance as a join students as s on a.S_ID = s.ID order by s.ROLL";
                }
            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res) == 0){
                echo "<tr><td colspan='8' class='p-5 text-center'>No students found for the selected course.</td></tr>";
            }

            // $query = "select * from attendance a join students s on a.S_ID = s.ID where s.COURSE = '$course'";
            $i=1;
            while($row = mysqli_fetch_assoc($res)){ 
                $count = "select COUNT(*) as total from attendance where S_ID = ".$row['S_ID'];
                $count_p = "select COUNT(*) as present from attendance where attendance = 'P' and S_ID = ".$row['S_ID'];
                $count_a = "select COUNT(*) as absent from attendance where attendance = 'A' and S_ID = ".$row['S_ID'];

                $countres = mysqli_query($conn , $count);
                $countrow = mysqli_fetch_assoc($countres);

                $countpres = mysqli_query($conn , $count_p);
                $countprow = mysqli_fetch_assoc($countpres);

                $countabs = mysqli_query($conn , $count_a);
                $countarow = mysqli_fetch_assoc($countabs);

                echo "<tr>";
                echo "<td class='border border-gray-500 p-3'>".$i++."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['S_ID']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['ROLL']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['NAME']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$countrow['total']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$countprow['present']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$countarow['absent']."</td>";
                echo "<td class='border border-gray-500 p-3'>".($countrow['total'] > 0 ? round(($countprow['present'] / $countrow['total']) * 100, 2) : 0)."%</td>";
                echo "</tr>";
                 
            }

        ?>
    </table>
</div>
</div>
<?php include 'footer.php'; ?>
        