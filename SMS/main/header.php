<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="font-serif bg-gray-200">
    <div class="w-[100%] fixed h-screen flex justify-between">
      <div class="w-[300px] bg-black text-white h-full">
        <div class="text-xl font-bold py-6 px-2 text-center shadow-b shadow-gray-500 shadow-sm border-white mb-5 tracking-widest">SMS<br><span class="text-lg tracking-normal">(school management system)</span></div>
        <ul class="p-5 text-lg w-full flex flex-col gap-2 space-y-2">
            <a href="index.php" class="p-2 menu"><li class="">Dashboard</li></a>
            <li class="group menu p-2 w-full">students
              <ul class="hidden group-hover:block w-full flex flex-col m-2">
                <a href="add_student.php" class="p-2 block menu"><li class="">Add student</li></a>
                <a href="view_students.php" class="p-2 block menu"><li class="">Show student</li></a>
              </ul> 
            </li>
            <!-- employee menu -->
            <a href="employee.php" class="p-2 menu"><li class="">Employee</li></a>
             <!-- <li class="group menu p-2 w-full">Employee
              <ul class="hidden group-hover:block w-full flex flex-col m-2">
                <a href="add_student.php" class="p-2 block menu"><li class="">Add Employee</li></a>
                <a href="view_students.php" class="p-2 block menu"><li class="">Show Employee</li></a>
              </ul> 
            </li> -->
            <!-- attendance menu section -->
             <li class="group menu p-2 w-full">Attendance
              <ul class="hidden group-hover:block w-full flex flex-col m-2">
                <a href="take_attendance.php" class="p-2 block menu"><li>Take Attendance</li></a>
                <a href="show_attendance.php" class="p-2 block menu"><li class="">Show attendance</li></a>
              </ul> 
            </li>
            <li class="p-2 menu">Fees</li>
            <li class="p-2 menu">Exams</li>
            <li class="p-2 menu">Library</li>
        </ul>
      </div>
      <div class="w-auto left-[300px] absolute right-0 h-full">
        <div class="h-15 w-full bg-white flex justify-between leading-15 px-5 text-lg shadow shadow-lg">
          <p> welcome <?php echo $_SESSION['name'] ?></p>
          <div><a href="logout.php" class="px-5 py-2 rounded text-white bg-blue-500">logout</a></div>
        </div>
            <div class="h-[90vh] bg-white rounded shadow-lg w-[96%] m-auto mt-4 py-5 relative">
              
        <script>
        document.querySelectorAll(".menu").forEach(item => {
          if (item.pathname === window.location.pathname) {
              item.classList.add("border", "rounded", "border-gray-500","w-full");
              }
          });


        </script>