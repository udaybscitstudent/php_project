<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="h-screen w-full flex items-center justify-center font-serif">
    <div class="w-[500px] h-auto border border-gray-300 rounded-lg p-6 shadow-lg">
      <h1 class="text-2xl font-bold text-center m-5">Student Registratin Form</h1>
      <form method="post">
        <div class="text-sm text-gray-700 w-[90%] mx-auto">
          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">Name</label>
            <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight w-full" id="name" name="name" type="text" placeholder="Enter name" />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="email">Email</label>
            <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight w-full" id="email" name="email" type="email" placeholder="Enter email" />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="mobile">Mobile</label>
            <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight w-full" id="mobile" name="mobile" type="text" placeholder="Enter mobile number" />
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="roll">Roll</label>
            <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight w-full" id="roll" name="roll" type="number" placeholder="Enter your roll" />
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="course">Course</label>
            <input class="border rounded w-full py-2 px-3 text-gray-700 leading-tight w-full" id="course" name="course" type="text" placeholder="Enter mobile number" />
          </div>
          
          <div class="flex items-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded" type="submit" name="submit">Submit</button>
            <a href="show.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 mx-4 rounded">show</a>
          </div>
        </div>
      </form>
    

<?php
$conn = mysqli_connect("localhost", "root","" ,"crud");
if(isset($_POST['submit'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $roll = $_POST['roll'];
  $course = $_POST['course'];
  $query = "insert into registration(NAME ,EMAIL,MOBILE,ROLL,COURSE) values('$name','$email','$mobile','$roll','$course')";
   $res = mysqli_query($conn, $query);
   if($res){
    echo "<p class='text-green-500 text-center m-5'>Data inserted successfully</p>";
   }else{
    echo "<p class='text-red-500 text-center m-5'>Data not inserted</p>";
   }
}


?>

    </div>
  </body>
</html>