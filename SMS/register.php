<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="h-screen w-full flex place-items-center justify-center font-serif bg-gray-100 text-sm">
    <div class="w-[450px] h-auto border border-gray-300 rounded-md bg-white font-bold pb-6">
        <h1 class="text-xl font-bold text-center m-5 text-white rounded-[50%] w-[50%] mx-auto p-3 bg-black">Register Page</h1>
        <form method="post">
            <div class="w-[90%] mx-auto">
                <div class="">
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Enter name" id="name" class="border border-gray-300 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div class="my-5">
                    <label for="email">Email</label>
                    <input type="text" name="email" placeholder="Enter email" id="email" class="border border-gray-300 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div class="my-5">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" placeholder="Enter mobile" id="mobile" class="border border-gray-300 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div class="mb-5">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter password" id="password" class="border border-gray-300 rounded w-full py-2 px-3 leading-tight w-full mt-1 outline-gray-500"  />
                </div>
                <div class="mb-2">
                    <label for="cpassword">Confirm-Password</label>
                    <input type="password" name="cpassword" placeholder="Enter password" id="cpassword" class="border border-gray-300 rounded w-full py-2 px-3 leading-tight w-full mt-1 outline-gray-500"  />
                </div>
                <button type="submit" name="register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded mt-4 w-full">Sign-up</button>
                <p class="text-center mt-2">Already have an account? <a href="index.php" class="text-blue-500">Login</a></p>
            </div>
        </form>
    

<?php
$conn = mysqli_connect("localhost", "root","" ,"auth");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if($password === $cpassword){
        $query = "insert into student(NAME,EMAIL,MOBILE,PASSWORD) values('$name' , '$email' , '$mobile' , '$password')";
        $res = mysqli_query($conn, $query);
        if($res){
            echo "<p class=\"text-green-500 text-center my-5\">Registration successful.</p>";
        }
        else {
            echo "<p class=\"text-red-500 text-center my-5\">Registration failed.</p>";
        }
    } else {
        echo "<p class=\"text-red-500 text-center my-5\">Passwords do not match.</p>";
    }

}
?>

    </div>
  </body>
</html>
