<?php
$title='User Registration';
include "../includes/db_conn.php";
include "../includes/css/login.css";

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
    <title><?=$title?></title>
    <style>
        .navbar-brand>img {
            height: 3rem;
            width: 7rem;
        }
    </style>

    <nav class="navbar navbar-expand navbar-light text-dark bg-light">
        <a class="navbar-brand" href="../index.php"><img src="../images/logo.png" alt="company logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Job Applications
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">View all jobs</a>
                    <a class="dropdown-item" href="#">View vacancies</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Submit your CV</a>
                  </div>
                </li>  -->
                <li class="nav-item">
                  <a class="nav-link" href="#">FAQs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
                </li>
        </ul>

        <div>Already have an account?<span><a class="mx-1" href="#">Login</a></span></div>

        </div>
    </nav>

    
</head>
<body style="background-color: #d3d3d3">
    <div class="container mt-4"> 
    <div class="row">
        <div class="col-lg-5 mt-2 mx-auto" id="alert">
        
        </div>
    </div>
    
 <!-- Begin registration form -->
            <div class="row">
                <div class="col-lg-4 col-sm-8 mx-auto rounded" id="register-box"  style="background: white">
                    <h2 class="text-center mt-2">Create an account</h2>
                    <form action="" method="POST" role="form" class="p-2" id="register_form">
                        <div class="input-group-sm">
                        <label for="fname">First Name:</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="input-group-sm">
                        <label for="lname">Last Name:</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="input-group-sm">
                        <label for="usermail">Email:</label>
                            <input type="email" name="usermail" id="usermail" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="input-group-sm">
                        <label for="phone_number">Phone Number:</label>
                            <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" required>
                        </div>
                        <div class="input-group-sm">
                        <label for="reg_pass">Password:</label>
                            <input type="password" name="reg_pass" id="reg_pass" class="form-control" placeholder="Enter password" required minlength="8">
                            <small class="text-muted">Password must be at least 8 characters</small>
                        </div>
                        <div class="input-group-sm">
                        <label for="reg_cpass">Confirm Password:</label>
                            <input type="password" name="reg_cpass" id="reg_cpass" class="form-control" placeholder="Confirm password" required minlength="8">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="customcheck" class="custom-control-input" id="customcheck" required>
                                <label for="customcheck" class="custom-control-label">I agree to the <a href="#" class="text-secondary">terms & conditions.</a></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" id="register" value="Register" class="btn btn-primary btn-block">
                        </div>
                        <div class="form-group">
                            <p class="text-center">Already created an account?<a href="login.php" id="login-btn" class="text-secondary"> Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End of registration form -->

            <div class="row">
            
        </div>
    </div>

<?php
include_once "../includes/footer.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
    var form = $("#register_form");

    form.validate({
        rules:{
            reg_cpass:{
                equalTo:"#reg_pass",
            }
        }
    });

    $("#register").click(function(e){        
        if(form.valid()){
            e.preventDefault();
            $("#register").val('Please Wait...');
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var usermail = $("#usermail").val();
            var phone = $("#phone_number").val();
            var reg_pass = $("#reg_pass").val();
            var reg_cpass = $("#reg_cpass").val();
            $.ajax({
            url:'action.php',
            method:'POST',
            data:{fname:fname,lname:lname,usermail:usermail,phone:phone,reg_pass:reg_pass,reg_cpass:reg_cpass,dataname:'registeruser'},
            success:function(response){
                //$(window).scrollTop(0);
                $("#alert").html(response);
                $("#register").val('Register');
                window.scrollTo({ top: 0, behavior: 'smooth' });  
            }
        });
        }
        return true;
    });
</script>