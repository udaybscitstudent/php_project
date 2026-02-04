<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="h-screen w-full flex place-items-center justify-center font-serif bg-gray-100 text-sm">
    <div class="w-[450px] h-[400px] border border-gray-300 rounded-md bg-white font-bold">
        <h1 class="text-xl font-bold text-center m-5 text-white rounded-[50%] w-[50%] mx-auto p-3 bg-black">Login Page</h1>
        <form method="post">
            <div class="w-[90%] mx-auto">
                <div class="">
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>" placeholder="Enter username" id="username" class="border border-gray-300 rounded w-full py-2 px-3  leading-tight w-full mt-1 outline-gray-500"/>
                </div>
                <div class="mt-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" placeholder="Enter password" id="password" class="border border-gray-300 rounded w-full py-2 px-3 leading-tight w-full mt-1 outline-gray-500"  />
                </div>
                <div class="mt-2 relative">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember me</label>
                    <a href="" class="absolute right-0">Forgot password</a>
                </div>
                <button type="submit" name="login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded mt-4 w-full">Login</button>
                <p class="text-center mt-2">don't have an account? <a href="register.php" class="text-blue-500">Sign up</a></p>
            </div>
        </form>
        <?php
            $conn = mysqli_connect("localhost", "root", "" ,"auth");
            if(isset($_POST['login'])){
                $username = $_POST['username'];
                if(isset($_COOKIE['password'])){
                    $password = $_COOKIE['password'];
                }
                else{
                    $password = md5($_POST['password']);
                }
                $query = "select * from admin where EMAIL = '$username' and PASSWORD = '$password'";
                $res = mysqli_query($conn, $query);
                if(mysqli_num_rows($res) > 0){
                    if(isset($_POST['remember'])){
                        setcookie("username" , $username , time() + (86400 * 30) , "/");
                        setcookie("password" , $password , time() + (86400 * 30) , "/");
                    }
                    $row = mysqli_fetch_assoc($res);
                    session_start();
                    $_SESSION['name'] = $row['NAME'];
                    $_SESSION['username'] = $row['EMAIL'];
                    header("Location: main/index.php");
                
                }
                else {
                    echo "<p class=\"text-red-500 text-center my-5\">Invalid username or password.</p>";
                }
            }
        ?>
    </div>
  </body>
</html>