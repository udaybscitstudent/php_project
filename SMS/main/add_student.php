<?php include 'checklogin.php'; ?>
<?php include 'header.php'; ?>
<!-- <div class="h-auto w-[90%] mx-auto my-10 bg-white p-10 rounded shadow-lg"> -->
    <form method="post">
        <div>
            <div class="mb-5">
                <label for="id">Id</label>
                <input type="text" name="id" placeholder="Enter id" id="id" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
            </div>
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter name" id="name" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
            </div>
            <div class="my-5">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Enter email" id="email" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
            </div>
            <div class="my-5">
                <label for="mobile">Mobile</label>
                <input type="number" name="mobile" placeholder="Enter mobile" id="mobile" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>   
            </div>
            <div>
                <label for="roll">Roll</label>
                <input type="number" name="roll" placeholder="Enter roll number" id="roll" class="border border-gray-400 rounded w-full py-2 px-3 leading-tight w-full mt-1 outline-gray-500"  />
            </div>
            <div class="mt-5 mb-2">
                <label for="course">Course</label>
                <select name="course" id="course" class="border border-gray-400 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500">
                    <option value="">Select Course</option>
                    <option value="BA">BA</option>
                    <option value="BSC">BSC</option>
                    <option value="BCA">BCA</option>
                    <option value="BSC.it">BSC.it</option>
                    <option value="BBA">BBA</option>
                    <option value="B.tech">B.tech</option>
                </select>
                <!-- <input type="text" name="course" placeholder="Enter course" id="course" class="border border-gray-400 rounded w-full py-2 px-3 leading-tight w-full mt-1 outline-gray-500"  /> -->
            </div>
            <button type="submit" name="add_student" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded mt-4 px-10">Add Student</button>
        </div>
    </form>

</div>
<?php include 'footer.php'; ?>

<?php
include 'conn.php';
if (isset($_POST['add_student'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $roll = $_POST['roll'];
    $course = $_POST['course'];

    $sql = "INSERT INTO students(ID, NAME, EMAIL, MOBILE, ROLL, COURSE) VALUES ('$id', '$name', '$email', '$mobile', '$roll', '$course')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Student added successfully');</script>";
        // echo "<script>window.location.href='view_students.php';</script>";
    } else {
        echo "<script>alert('Error adding student');</script>";
        // echo "<script>window.location.href='add_student.php';</script>";
    }
}

?>
        