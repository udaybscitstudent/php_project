<?php 
include 'checklogin.php';
include 'header.php'; 
include 'conn.php';
?>
<div class="relative">
    <span class="text-xl ml-[5%] font-bold p-2 rounded border-b cursor-pointer" id="addEmployee">Add Employee</span>
    <div class="w-[90%] m-auto flex justify-between my-5 mt-8 items-center">
        <div>Record
            <select class="border border-gray-400 appearance-none w-15 rounded text-center">
                <option class="">10</option>
                <option class="">20</option>
                <option class="">30</option>
            </select>
        </div>
        <select class="border bg-gray-100 appearance-none border-gray-500 rounded-full mx-auto block px-3 py-2 w-[500px] outline-gray-500 role">
            <option value="" class="text-center"><?php echo (isset($_GET['role'])) ? " Selected Role : ".$_GET['role'] : "------- Select Role -------"; ?></option>
                <option value="Teacher">Teacher</option>
                <option value="Accountant">Accountant</option>
                <option value="Librariant">Librarian</option>
                <option value="Receptionist">Receptionist</option>
                <option value="Security">Security</option>
                <option value="HouseKeeping">Housekeeping</option>
                <option value="All">All</option>
        </select>
        <div class="relative">
            <!-- <label for="search">Search</label> -->
            <div class="border border-gray-400 rounded py-0 mr-4 ">
                <input id="search" type="search" name="eSearch" class="rounded pl-2 py-1 outline-none search" placeholder="search">
                <i class="bi bi-exclamation-circle text-black pr-1 group"><p class="hidden group-hover:block absolute -top-6 right-5 text-gray-500">search by Name or Id </p></i>
            </div>
        </div>
    </div>
    <script>
        document.querySelector(".role").addEventListener("change", function () {
            let selectedRole = this.value;
            window.location.href = "employee.php?role=" + selectedRole;
        });

        document.querySelector(".search").addEventListener("change", function(){
            let emp = this.value;
            window.location.href= "employee.php?emp=" + emp;
        })
    </script>
        
<!-- <div class="h-[70vh] overflow-y-auto"> -->
    <table class="border-collapse border-slate-400 mx-auto w-[90%] text-center">
        <tr class="bg-gray-500 p-3 text-white  sticky top-0">
            <th class="p-3 border border-gray-500 border-t-0">SI.No</th>
            <th class="p-3 border border-gray-500 border-t-0">Emp_ID</th>
            <th class="p-3 border border-gray-500 border-t-0">Emp_Name</th>
            <th class="p-3 border border-gray-500 border-t-0">Emp_Email</th>
            <th class="p-3 border border-gray-500 border-t-0">Emp_Mobile</th>
            <th class="p-3 border border-gray-500 border-t-0">Emp_DOB</th>
            <th class="p-3 border border-gray-500 border-t-0">Emp_Address</th>
            <th class="p-3 border border-gray-500 border-t-0">Emp_Role</th>
        </tr>
        <?php
            if(isset($_GET['role'])) {
                $role = $_GET['role'] ?? '';
                $query = "select * from employee where Emp_Role = '$role' ";
                }
                if((!isset($_GET['role'])) || $_GET['role'] == 'All'|| isset($_GET['emp'])){
                    if(isset($_GET['emp'])){
                        $emp = $_GET['emp'] ?? '';
                        $query = "select * from employee where Emp_Name = '$emp' OR Emp_id = '$emp' ";
                    }else{
                    $course = $_GET['role'] ?? '';
                    $query = "select * from employee";
                    }
                }
            $res = mysqli_query($conn, $query);
            if(mysqli_num_rows($res) == 0){
                echo "<tr><td colspan='7' class='p-5 text-center'>No employee found for the selected Role.</td></tr>";
            }
            $i=1;
            while($row = mysqli_fetch_assoc($res)){
                echo "<tr>";
                echo "<td class='border border-gray-500 p-3'>".$i++."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['Emp_id']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['Emp_Name']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['Emp_Email']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['Emp_Mobile']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['Emp_DOB']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['Emp_Address']."</td>";
                echo "<td class='border border-gray-500 p-3'>".$row['Emp_Role']."</td>";
                echo "</tr>";
                 
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
                    <input type="text" name="Eid" placeholder="Enter emp id" id="id" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div>
                    <label for="name">Emp Name</label>
                    <input type="text" name="Ename" placeholder="Enter emp name" id="name" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div class="my-5">
                    <label for="email">Emp Email</label>
                    <input type="text" name="Eemail" placeholder="Enter emp email" id="email" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div class="my-5">
                    <label for="mobile">Emp Mobile</label>
                    <input type="number" name="Emobile" placeholder="Enter emp mobile" id="mobile" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>   
                </div>
                <div class="my-5">
                    <label for="mobile">Date-of-Birth</label>
                    <input type="date" name="Edob" id="mobile" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>   
                </div>
                <div class="my-5">
                    <label>Address</label>
                    <textarea name="Eaddress"  placeholder="Enter address" class="border w-full rounded border-gray-400 p-2 outline-gray-500"></textarea>
                </div>
                <div>
                    <lable>Role</lable><br>
                    <select class="border border-gray-400 rounded w-full py-2 px-3 leading-tight w-full mt-1 outline-gray-500" name="Erole">  
                        <option>select Role</option>
                        <option value="Teacher">Teacher</option>
                        <option value="Accountant">Accountant</option>
                        <option value="Librariant">Librarian</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Security">Security</option>
                        <option value="HouseKeeping">Housekeeping</option>
                    </select>
                    <!-- <input type="number" name="roll" placeholder="Enter roll number" id="roll" class="border border-gray-400 rounded w-full py-2 px-3 leading-tight w-full mt-1 outline-gray-500"  /> -->
                </div>
                 
                <button type="submit" name="add_employee" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded mt-4 px-10">Add Employee</button>
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
<?php
if(isset($_POST['add_employee'])){
    $eid = $_POST['Eid'];
    $ename = $_POST['Ename'];
    $eemail = $_POST['Eemail'];
    $emobile = $_POST['Emobile'];
    $edob = $_POST['Edob'];
    $eaddress = $_POST['Eaddress'];
    $erole = $_POST['Erole'];

    $query = "INSERT INTO `employee` (`Emp_id`, `Emp_Name`, `Emp_Email`, `Emp_Mobile`, `Emp_DOB`, `Emp_Address`, `Emp_Role`) VALUES ($eid, '$ename', '$eemail', $emobile, '$edob', '$eaddress' ,'$erole')";
    $res = mysqli_query($conn , $query);
    if($res){
        echo "<script>alert(`New employee added successfully`)</script>";
        }
        else{
        echo "<script>alert(`ailed to add`)</script>";
    }

}

?>
<?php include 'footer.php'; ?>