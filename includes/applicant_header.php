<?php
include "../includes/db_conn.php";
session_start();

if(!isset($_SESSION['user'])){
    $redirect = $_SERVER['PHP_SELF'];
    if ($_GET['id'] != ''){
      $id = $_GET['id'];      
      header("Location:../account/login.php?redirect=$redirect?id=$id");
    }else{
       // $_SESSION["Login-redirect"]=$_SERVER['PHP_SELF'];
      header("Location:../account/login.php?redirect=$redirect");
    }
   
    exit();
}
$user=$_SESSION['user'];
$sql="SELECT * FROM job_users WHERE email='$user'";
$result=$conn->query($sql);
$user=$result->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3b8c65f5c7.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>   
    <!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>  -->
    <title><?=ucfirst($_SERVER['PHP_SELF'])?></title>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffffff">
  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php"><i class="fas fa-columns"></i> My applications</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="jobs.php"><i class="fas fa-briefcase"></i> Jobs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="fas fa-bell"></i> Notifications</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="profile.php"><i class="fas fa-user-circle"></i> My Profile</a>
      </li>
      
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown link
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
    </ul>
    
  </div>
  <div class="border rounded-lg shadow-sm pull-right text-muted">
    <h6 class="p-1"><span><i class="fas fa-user"></i></span> <?php
     echo $user['lname'].' '.$user['fname'];
    ?></h6>
  </div>
  <div class="pull-right"><a class="nav-link text-secondary" href="../account/logout.php"><span><i class="fa fa-sign-out" aria-hidden="true"></i></span> Logout</a></div>
</nav>
<style>
    a:link{
        color: #696969 !important;   
    }
    a:hover{
        color: #d3d3d3 !important;
    }
</style>
</head>
<body class="" style="background-color: #d3d3d3">