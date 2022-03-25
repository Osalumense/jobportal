<?php
$title='User Registration';
include "header.php";

?>

<section>
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
                        <div class="mb-3">
                        <label for="fname">First Name:</label>
                            <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="mb-3">
                        <label for="lname">Last Name:</label>
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="mb-3">
                        <label for="usermail">Email:</label>
                            <input type="email" name="usermail" id="usermail" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="mb-3">
                        <label for="phone_number">Phone Number:</label>
                            <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                        <label for="reg_pass">Password:</label>
                            <input type="password" name="reg_pass" id="reg_pass" class="form-control" placeholder="Enter password" required minlength="8">
                            <small class="text-muted">Password must be at least 8 characters</small>
                        </div>
                        <div class="mb-3">
                        <label for="reg_cpass">Confirm Password:</label>
                            <input type="password" name="reg_cpass" id="reg_cpass" class="form-control" placeholder="Confirm password" required minlength="8">
                        </div>
                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="customcheck" class="custom-control-input" id="customcheck" required>
                                <label for="customcheck" class="custom-control-label">I agree to the <a href="#" class="text-secondary">terms & conditions.</a></label>
                            </div>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <input type="submit" name="register" id="register" value="Register" class="btn btn-primary">
                        </div>
                        <div class="mb-3">
                            <p class="text-center">Already created an account?<a href="login.php" id="login-btn" class="text-primary"> Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End of registration form -->

            <div class="row">
            
        </div>
    </div>
</section>

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