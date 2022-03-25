<?php
$title='Reset Password';
include "header.php";


?>


<section>
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
                        <p class="text-muted">Enter your email and password reset instructions will be sent to you</p>
                    </div>
                    <div class="form-group">
                        <label for="reset-mail">Email:</label>
                        <input type="email" name="reset-mail" id="reset-mail" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="d-grid gap-2 my-3">
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
</section>


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

