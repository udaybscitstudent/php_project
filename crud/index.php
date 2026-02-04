<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="h-auto w-full flex justify-center font-serif">
    <div class="w-[1000px] h-auto border border-gray-300 rounded-lg p-6 shadow-lg my-10">
      <?php
      session_start();
      if(isset($_SESSION['inserted'])){
        echo "<p class='text-green-500 text-center m-5 text-lg status'>Data inserted successfully</p>";
        unset($_SESSION['inserted']);
      }
      if(isset($_SESSION['updated'])){
        echo "<p class='text-yellow-500 text-center m-5 text-lg status'>Data updated successfully</p>";
        unset($_SESSION['updated']);
      }
      if(isset($_SESSION['deleted'])){
        echo "<p class='text-red-500 text-center m-5 text-lg status'>Data deleted successfully</p>";
        unset($_SESSION['deleted']);
      }
      ?>
      <h1 class="text-2xl font-bold text-center m-5">Student Registration Data</h1>
        <table border="1" class="w-full text-center border-collapse mb-5">
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Mobile</th>
                <th class="border px-4 py-2">Roll</th>
                <th class="border px-4 py-2">Course</th>
                <th class="border px-4 py-2">Action</th>

            </tr>
    

<?php
$conn = mysqli_connect("localhost", "root","" ,"crud");
    $query = "select * from registration";
    $res = mysqli_query($conn, $query);
   if(mysqli_num_rows($res) > 0){
    while($row = mysqli_fetch_assoc($res)){
        ?>
            <tr>
                <td class="border px-4 py-2"><?php echo $row['NAME']; ?></td>
                <td class="border px-4 py-2"><?php echo $row['EMAIL']; ?></td>
                <td class="border px-4 py-2"><?php echo $row['MOBILE']; ?></td>
                <td class="border px-4 py-2"><?php echo $row['ROLL']; ?></td>
                <td class="border px-4 py-2"><?php echo $row['COURSE']; ?></td>
                <td class="border px-4 py-2">
                    <a href="update.php?ROLL=<?php echo $row['ROLL']; ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded mr-2">Edit</a>
                    <a href="delete.php?ROLL=<?php echo $row['ROLL']; ?>" onclick="return confirm('Are you sure you want to delete this record?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</a> 
            </tr>
    <?php
    }
   }
    else{
        echo "<tr><td colspan='6' class='text-red-500 text-centerm-5'>No records found</td></tr>";
}
?>

</table>
<a href="insert.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded">add new student</a>
    </div>
    <script>

      setTimeout(() => {
        const statusElement = document.querySelector('.status');
        if (statusElement) {
          statusElement.remove();
        }
      }, 10000);
    </script>

  </body>
</html>