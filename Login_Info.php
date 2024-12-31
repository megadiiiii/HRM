<?php 
$username = '';
$staff_name = '';
$role = '';

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $sql = "SELECT * FROM account WHERE username = '$username'";
  $result = mysqli_query($con, $sql);

  if ($result) {
      if ($row = mysqli_fetch_assoc($result)) {
          $staff_name = $row['staff_name'];
          $role = $row['role'];
          $username = $row['username'];
      }
  }
}
?>