<?php
$serverName='localhost';
$userName='root';
$password='';
$dbName='practice';

$conn = mysqli_connect($serverName, $userName, $password, $dbName);
if(!$conn) {
    die('Connection failed: '.mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
   $file_name = $_FILES['avatar']['name'];
   $fileTemp_name = $_FILES['avatar']['tmp_name'];
    // $file_size = $_FILES['avatar']['size'];
    // $file_error = $_FILES['avatar']['error'];
    $file_type = $_FILES['avatar']['type'];

    $dest = "fileHandle/";
    move_uploaded_file($fileTemp_name, $dest.$file_name);
    $file_path = $dest.$file_name;
    $sql = "INSERT INTO `image` (filePath) VALUES ('$file_path')";
    // echo $file_path;
    $result = mysqli_query($conn, $sql);

    $gettingfile = "SELECT * FROM `image`";
    $res=mysqli_query($conn, $gettingfile);
    if(mysqli_num_rows($res) > 0) {
        while($row = mysqli_fetch_assoc($res)) {
            echo "<img src='".$row['filePath']."' alt='image' width='100px' height='100px'>";
        }
    }
    else {
        echo "No image found";
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h1>File upload</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar">
        <input type="submit" value="Upload">
    </form>
</body>
</html>