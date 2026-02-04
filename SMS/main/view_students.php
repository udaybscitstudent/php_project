<?php 
include 'checklogin.php';
include 'header.php'; 
include 'conn.php';
?>
 
<div class="h-[85vh] bg-white rounded shadow-lg w-[90%] m-auto mt-8 py-5">
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
            window.location.href = "view_students.php?course=" + selectedCourse;
        });
    </script>
        
<div class="h-[70vh] overflow-y-auto">
    <table class="border-collapse border-slate-400 mx-auto w-[90%] text-center">
        <tr class="bg-gray-500 p-3 text-white  sticky top-0">
            <th class="p-3 border border-gray-500 border-t-0">SI.No</th>
            <th class="p-3 border border-gray-500 border-t-0">ID</th>
            <th class="p-3 border border-gray-500 border-t-0">Name</th>
            <th class="p-3 border border-gray-500 border-t-0">Email</th>
            <th class="p-3 border border-gray-500 border-t-0">Mobile</th>
            <th class="p-3 border border-gray-500 border-t-0">Roll No</th>
            <th class="p-3 border border-gray-500 border-t-0">Course</th>
        </tr>
        <?php
            if(isset($_GET['course'])) {
                $course = $_GET['course'] ?? '';
                $query = "select * from students where COURSE = '$course' order by ROLL";
            }
            if((!isset($_GET['course'])) || $_GET['course'] == 'ALL')
                {
                    $course = $_GET['course'] ?? '';
                    $query = "select * from students order by ROLL";
                }
            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res) == 0){
                echo "<tr><td colspan='7' class='p-5 text-center'>No students found for the selected course.</td></tr>";
            }
            $i=1;
            while($row = mysqli_fetch_assoc($res)){
                echo "<tr>";
                echo "<td class='border border-gray-500 p-3'>".$i++."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['ID']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['NAME']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['EMAIL']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['MOBILE']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['ROLL']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['COURSE']."</td>";
                echo "</tr>";
                 
            }

        ?>
    </table>
</div>
</div>


<?php include 'footer.php'; ?>