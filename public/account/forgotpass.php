<?php
$title='Reset Password';
include "../includes/db_conn.php";


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
    
</head>
<body class="jumbotron">
    <div class="container mt-4"> 
        <div class="row">
            <div class="col-lg-4 mx-auto" id="alert">
            </div>
        </div>
        <!--Begin forgot password -->
        <div class="row">
            <div class="col-lg-4 offset-lg-4 mt-2 rounded" id="forgot-box"  style="background: white">
                <h2 class="text-center mt-2">Reset Password</h2>
                <form action="" method="POST" role="form" class="p-2" id="forgot-form">
                    <div class="form-group text-center">
                        <small class="text-muted">Enter your email and password reset instructions will be sent to you</small>
                    </div>
                    <div class="form-group">
                        <label for="reset-mail">Email:</label>
                        <input type="email" name="reset-mail" id="reset-mail" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="forgot_btn" id="forgot_btn" value="Reset password" class="btn btn-primary btn-block">
                    </div>
                    <div class="form-group text-center">
                        <a href="login.php" id="back-btn">Back</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- end forgot password -->

    </div>

<?php
include_once "../includes/footer.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
    $("#forgot-form").validate();

    $("#forgot_btn").click(function(e){
        if($("#forgot-form").valid()){
            e.preventDefault();
            $("#forgot_btn").val('Please Wait...');
            var email = $("#reset-mail").val();

            $.ajax({
                url:"action.php",
                method:"POST",
                data:{email:email,dataname:'resetpass'},
                success:function(response){
                    $("#alert").html(response);
                    $("#forgot_btn").val('Reset Password');
                }
            });       
        }
    });


</script>

