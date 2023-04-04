<?php
session_start();
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])) {
   include_once('config.php');
   $email = $_POST['email'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM accounts_swim WHERE email = '$email' and password = '$password'";

   $result = $conection->query($sql);

   if (mysqli_num_rows($result) < 1) {
      $row = $result->fetch_assoc();
      unset($_SESSION['email']);
      unset($_SESSION['password']);
      unset($_SESSION['name']);
      header('Location: login.php');
   } 
   else
   {
      $row = $result->fetch_assoc();
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      $_SESSION['name'] = $row['name'];
      header('Location: home.php');
   }
} else {
   header('Location: login.php');
}
;

?>