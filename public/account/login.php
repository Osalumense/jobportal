<?php
include_once "../includes/header.php";

if(isset($_SESSION['user'])){
    if(isset($_GET['redirect'])){
        header("Location:".$_GET['redirect']);
    }else{
        header("Location:../applicant/dashboard.php");
    }
}
?>


    <div class="container mt-4"> 
        <div class="row">
            <div class="col-lg-5 mx-auto" id="alert">
            </div>
        </div>
        
        
        <!-- Begin login form -->
        <div class="row">
            <?php
                if(isset($_GET['redirect'])){
                    $redirect = $_GET['redirect'];
                }else{
                    $redirect = '';
                }
            ?>
            <div class="col-lg-4 mx-auto rounded" id="login-box"  style="background: white">
                <h2 class="text-center mt-2">Login</h2>
                <form action="" method="post" role="form" class="p-2" id="login-form">
                    <div class="form-group">
                    <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="input-group-sm">
                    <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" required minlength="8">
                        <div class="input-group-append my-1" role="button">
                            <small><input type="checkbox" id="showpass"> Show Password</small>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="custom-control custom-checkbox">
                            <a href="forgotpass.php" id="forgot-btn" class="float-right text-secondary">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" id="login" value="Login" class="btn btn-primary btn-block">
                    </div>
                    <div class="form-group">
                        <p class="text-center">Don't have an account yet?<a href="register.php" id="register-btn" class="text-secondary"> Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- end of login form -->
    </div>

<?php
include_once "../includes/footer.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
    var form = $("#login-form");
    form.validate();

    $(document).on("change", "#login-form", function(){
        $("#alert").empty(); 
    });

    $("#showpass").click(function(){
        var pass = $("#password");
        if(pass.attr("type") == "password"){
            pass.attr("type", "text");
        }
        else{
            pass.attr("type", "password");
        }
    });

    $("#login").click(function(e){
        $("#alert").empty();
        if(form.valid()){
            e.preventDefault();
            $("#login").val('Please Wait...');
            var redirect = $.trim('<?=$redirect;?>');
            var email = $("#email").val();
            var pass =  $("#password").val();
            $.ajax({
                url:'action.php',
                method:'POST',
                data:{email:email,pass:pass,dataname:'userlogin'},
                success:function(response){
                    if(response==='successful'){
                        if(redirect == ''){
                            window.location='../applicant/dashboard.php';
                        }
                        else{
                            window.location=redirect;
                        }
                        
                    }else{
                        $("#alert").html(response);
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        $("#login").val('Login');
                    }

                }

           });
        }
    });
</script>



