<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['pass']);
$sql = "select id, fullname, email from customers where email = '".$username."' and password = '".md5($password)."'";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
 
  $row = $result->fetch_assoc();
  
  
  setcookie("user",$row['email'], time() + (86400 / 24), "/");
  setcookie("fullname", $row['fullname'], time() + (86400 / 24), "/");
  setcookie("id", $row['id'], time() + (86400 / 24), "/");
  
  //session
  session_start();
  
  $_SESSION['user'] = $row['email'];
  $_SESSION['fullname'] = $row['fullname'];
  $_SESSION['id'] = $row['id'];

  header('Location: homepage.php');
  header('Location: homepage-profile.php');
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  //Tro ve trang dang nhap sau 3 giay
  header('Refresh: 3;url=login.php');

}

$conn->close();
?>

