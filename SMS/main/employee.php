<?php 
include 'checklogin.php';
include 'header.php'; 
include 'conn.php';
?>
<div class="relative">
    <span class="text-xl ml-[5%] font-bold py-1 border-b cursor-pointer" id="addEmployee">Add Employee</span>
    <div class="w-[90%] m-auto flex justify-between my-5 mt-8 items-center">
        <div>Record
            <select class="border border-gray-400 appearance-none w-15 rounded text-center">
                <option class="">10</option>
                <option class="">20</option>
                <option class="">30</option>
            </select>
        </div>
        <select class="border bg-gray-100 appearance-none border-gray-500 rounded-full mx-auto block px-3 py-2 w-[500px] outline-gray-500 course">
            <option value="" class="text-center"><?php echo (isset($_GET['course'])) ? " Selected Course : ".$_GET['course'] : "------- Select Course -------"; ?></option>
            <option value="BA">BA</option>
            <option value="BSC">BSC</option>
            <option value="BCA">BCA</option>
            <option value="BSC.it">BSC.it</option>
            <option value="BBA">BBA</option>
            <option value="B.tech">B.tech</option>
            <option value="ALL">All</option>
        </select>
        <div class="relative">
            <!-- <label for="search">Search</label> -->
            <div class="border border-gray-400 rounded py-0 mr-4 ">
                <input id="search" type="search" class="rounded pl-2 py-1 outline-none" placeholder="search">
                <i class="bi bi-exclamation-circle text-black pr-1 group"><p class="hidden group-hover:block absolute -top-6 right-5 text-gray-500">search by Name or Id </p></i>
            </div>
        </div>
    </div>
    <script>
        document.querySelector(".course").addEventListener("change", function () {
            let selectedCourse = this.value;
            window.location.href = "view_students.php?course=" + selectedCourse;
        });
    </script>
        
<!-- <div class="h-[70vh] overflow-y-auto"> -->
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
                // echo "<tr>";
                // echo "<td class='border border-gray-500 p-3'>".$i++."</td>";
                // echo "<td class='border border-gray-500 p-3'>".$row['ID']."</td>";
                // echo "<td class='border border-gray-500 p-3'>".$row['NAME']."</td>";
                // echo "<td class='border border-gray-500 p-3'>".$row['EMAIL']."</td>";
                // echo "<td class='border border-gray-500 p-3'>".$row['MOBILE']."</td>";
                // echo "<td class='border border-gray-500 p-3'>".$row['ROLL']."</td>";
                // echo "<td class='border border-gray-500 p-3'>".$row['COURSE']."</td>";
                // echo "</tr>";
                 
            }

        ?>
    </table>
</div>


<div id="employee" class="opacity-0 scale-95 pointer-events-none z-10 absolute border border-gray-200 w-[600px] bg-white rounded shadow-md shadow-gray-400 -translate-x-1/2 left-1/2 top-1/2 -translate-y-1/2 transition-all duration-200 ease-in-out">
    <div class="w-[90%] m-auto py-5">
        <h1 class="text-2xl font-bold py-2">Add new Employee</h1>
        <i class="bi bi-x text-3xl absolute top-2 right-2 cursor-pointer close"></i>
        <form method="post">
            <div>
                <div class="mb-5">
                    <label for="id">Emp Id</label>
                    <input type="text" name="id" placeholder="Enter emp id" id="id" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div>
                    <label for="name">Emp Name</label>
                    <input type="text" name="name" placeholder="Enter emp name" id="name" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div class="my-5">
                    <label for="email">Emp Email</label>
                    <input type="text" name="email" placeholder="Enter emp email" id="email" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div class="my-5">
                    <label for="mobile">Emp Mobile</label>
                    <input type="number" name="mobile" placeholder="Enter emp mobile" id="mobile" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>   
                </div>
                <div class="my-5">
                    <label for="mobile">Date-of-Birth</label>
                    <input type="date" name="dob" id="mobile" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>   
                </div>
                <div class="my-5">
                    <label>Address</label>
                    <textarea name="address"  placeholder="Enter address" class="border w-full rounded border-gray-400 p-2 outline-gray-500"></textarea>
                </div>
                <div>
                    <lable>Role</lable><br>
                    <select class="border border-gray-400 rounded w-full py-2 px-3 leading-tight w-full mt-1 outline-gray-500">  
                        <option>select Role</option>
                        <option>Teacher</option>
                        <option>Accountant</option>
                        <option>Librarian</option>
                        <option>Receptionist</option>
                        <option>Security</option>
                        <option>Housekeeping</option>
                    </select>
                    <!-- <input type="number" name="roll" placeholder="Enter roll number" id="roll" class="border border-gray-400 rounded w-full py-2 px-3 leading-tight w-full mt-1 outline-gray-500"  /> -->
                </div>
                 
                <button type="submit" name="add_student" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded mt-4 px-10">Add Employee</button>
            </div>
        </form>
    </div>
    <script>
        let add_emp = document.querySelector("#addEmployee");
        let emp = document.querySelector("#employee");
        let cls = document.querySelector(".close");
        add_emp.addEventListener("click", function(){
            emp.classList.remove("opacity-0", "scale-95", "pointer-events-none");
            emp.classList.add("opacity-100", "scale-100");
        })

        cls.addEventListener("click" , function(){
            emp.classList.remove("opacity-100", "scale-100");
            emp.classList.add("opacity-0", "scale-95", "pointer-events-none");
        })

    </script>
</div>
</div>
<?php include 'footer.php'; ?>