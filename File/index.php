<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  </head>
  <body class="h-screen w-full flex items-center justify-center font-serif">
    <div class="p-5">
        <form method="post" enctype="multipart/form-data" class="border border-gray-300 rounded-md p-5 bg-white w-[400px]">
            <h1 class="text-xl font-bold text-center mb-5">Upload File</h1>
            <label for="file" class="text-center font-bold text-lg">select File: <span class="file_name"></span></label>
            <input type="file" name="uploaded_file" id="file" class="border border-gray-500 p-1.5 rounded mb-4 hidden" onchange="previewImage(event)"/>
            <div class="w-40 h-45 mt-5 mx-auto mb-4 cursor-pointer border-dashed border-2 border-gray-500 flex items-center justify-center">
                <img id="preview" class="mx-auto rounded w-full h-full object-cover"/>
            </div>
            
            <div class="text-center text-gray-600 mb-4">Supported formats: jpg, png, pdf. Max size: 5MB.</div>
            <button type="submit" name="upload" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 mt-5 rounded">Upload</button>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const img = document.getElementById('preview');
            // const lbl = document.querySelector('label');
            const file_name = document.querySelector('.file_name');
            img.src = URL.createObjectURL(event.target.files[0]);
            // lbl.classList.add('hidden');
            file_name.innerText = event.target.files[0].name;
        }
    </script>
  </body>
<html>

<?php

if(isset($_POST['upload'])) {
    // print_r($_FILES['uploaded_file']);
    $file_name = time()."_".$_FILES['uploaded_file']['name'];
    $file_tmp = $_FILES['uploaded_file']['tmp_name'];
    $file_type= $_FILES['uploaded_file']['type'];
    $file_size= $_FILES['uploaded_file']['size'];
    if($file_type=='image/jpeg' || $file_type=='image/jpg' || $file_type=='image/png'){
        if($file_size < 2*1024*1024){
            if(move_uploaded_file($file_tmp, "uploads/" . $file_name)){
                echo "<script>alert('File uploaded successfully');</script>";
            }
            else{
                echo "<script>alert('File upload failed');</script>";
            }
        }
        else{
             echo "<script>alert('File size is less than 2MB');</script>";
        }
    }
    else{
             echo "<script>alert('File type should by JPEG,JPG,PNG');</script>";
    }
}

?>