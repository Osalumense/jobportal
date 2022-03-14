<?php
include "../includes/db_conn.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Confirm Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3b8c65f5c7.js" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #d3d3d3">


<?php
    $vacid = $_GET['id'];
    if(!isset($vacid)){
        header("Location:../jobs.php");
    }
    else{
        echo '';
    }
?>


<div class="container">
    <div class="row">
            <div class="col-lg-5 mt-3 mb-n2 mx-auto" id="alert">
            </div>
        </div>
    <div class="row mx-auto my-3 col-lg-6 rounded" style="background: white" id="chk_acct">
        <div class="col-lg-12 my-3">
                <h2 class="text-center mt-2">&nbsp; Confirm Account</h2><br>
                <h5 class="text-center">Do you have an account already?</h5>
        </div>
        <div class="col-lg-6 my-3">
                    <!-- <a class="btn btn-success btn-block" href="account_check.php?id=<?=$id?>"><span><i class="fa fa-check" aria-hidden="true"></i></span> Yes</a> -->
                    <button class="btn btn-success btn-block" id="show_confirm_account"><i class="fa fa-check"></i> Yes</button>
                </div>
                <div class="col-lg-6 my-3">
                    <!-- <a class="btn btn-danger btn-block" href="create_account.php?id=<?=$id?>"><span><i class="fa fa-times" aria-hidden="true"></i></span> No</a> -->
                    <button class="btn btn-danger btn-block" id="show_reg_account"><i class="fa fa-times"></i> No</button>
        </div>
    </div>
    <div class="row mx-auto">
                
    </div>

        <div class="row" style="display:none" id="confirm_acct">
            <div class="col-lg-6 my-3 mx-auto rounded" style="background: white">
                <h2 class="text-center mt-2">Confirm Account</h2>
                <form action="" method="post" id="confirm_acct_form" role="form" class="p-2">
                    <div class="form-group">
                    <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group mb-4">
                    <label for="password">Phone Number</label>
                        <input type="text" id="phone_num" name="phone_num" class="form-control" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="form-group my-4">
                        <input type="submit" name="confirm_acct" id="confirm_acct" data-target="#exampleModalCenter" data-toggle="moodal" value="Confirm Account" class="btn btn-primary btn-block">
                    </div>
                    <div class="form-group">
                        <p class="text-center"><a href="" id="bck-btn" class="text-secondary">Click here to go back</a></p>
                    </div>
                </form>
            </div>
        </div>

        <div class="row"  id="register_acct" style="display:none">
            <div class="col-lg-6 my-3 mx-auto rounded" style="background: white">
                <h2 class="text-center mt-2">Create Account</h2>
                <form action="" id="register_acct_form" method="post" role="form" class="p-2">
                    <div class="form-group">
                    <label for="surname">Surname</label>
                        <input type="text" id="surname" name="surname" class="form-control" placeholder="Enter Surname" required>
                    </div>

                    <div class="form-group">
                    <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter First Name" required>
                    </div>

                    <div class="form-group">
                    <label for="reg_email">Email</label>
                        <input type="email" id="reg_email" name="reg_email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group mb-4">
                    <label for="reg_phone_num">Phone Number</label>
                        <input type="text" id="reg_phone_num" name="reg_phone_num" class="form-control" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="form-group my-4">
                        <input type="submit" name="reg_acct" id="reg_acct" value="Create Account" class="btn btn-primary btn-block">
                    </div>
                    <div class="form-group">
                        <p class="text-center"><a href="" id="reg-bck-btn" class="text-secondary">Click here to go back</a></p>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title mx-auto" id="exampleModalLongTitle">Verify Details</h2>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> -->
      </div>
      <div id="msg_sent" class="mx-3"></div>
      <h6 class="mx-3 mt-2">Please confirm that these are your account details as the link to the eligibility test for this job would be sent to this mail</h6>
      <div class="modal-body">
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" id="exist_name" class="form-control"  disabled>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" id="exist_email" class="form-control"  disabled>
        </div>
        <div class="form-group">
            <label for="">Phone Number</label>
            <input type="text" id="exist_phone" class="form-control"  disabled>
        </div>
        <input type="text" id="exist_uid" class="form-control"  hidden>
      </div>
      <div id="busy_logo" class="mx-auto" style="display:none">
        <img src="../includes/loader.gif" height="40px" width="40px" alt="">
      </div>
      
      <div class="modal-footer">
        
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
        <button type="button" id="send_link" class="btn btn-success">Send Link</button>
      </div>
    </div>
  </div>
</div>

</div>
    
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
    var ajaxurl = "action.php";
    var vacid = '<?=$vacid?>';

    

    $("#show_confirm_account").click(function(){
        $("#chk_acct").hide();
        $("#confirm_acct").show();
    });

    $("#show_reg_account").click(function(){
        $("#chk_acct").hide();
        $("#register_acct").show();
    });

    $("#bck-btn").click(function(){
        $("#confirm_acct").hide();
        $("#chk_acct").show();        
    });

    $("#reg-bck-btn").click(function(){
        $("#register_acct").hide();
        $("#chk_acct").show();
    });

    //Send ajax request to confirm existing user
    $("#confirm_acct").click(function(e){
        e.preventDefault();
        if($("#confirm_acct_form").valid()){
            $("#confirm_acct").val('Please Wait...');
            var email = $("#email").val();
            var phone_num = $("#phone_num").val();
            $.ajax({
                url:ajaxurl,
                method:"POST",
                dataType:"JSON",
                data:{email:email,phone_num:phone_num,vacid:vacid,dataname:'confirm_acct'},
                success:function(data){
                    $("#confirm_acct").val('Confirm Account');
                    if(data.record == 'yes'){
                        $("#confirm_acct").hide();
                        $("#detailsModal").modal('show');
                        $("#exist_name").val(data.name);
                        $("#exist_email").val(data.email);
                        $("#exist_phone").val(data.phone_num);
                        $("#exist_uid").val(data.uid);
                    }
                    else{
                        $("#alert").html(data.msg);
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        $("#alert").delay(4000).fadeOut();
                    }
                }
            });          
        }
    });

    //Send ajax request to register new user
    $("#reg_acct").click(function(e){
        e.preventDefault();
        if($("#register_acct_form").valid()){
            $("#reg_acct").val('Please Wait...');
            var surname = $("#surname").val();
            var fname = $("#first_name").val();
            var email = $("#reg_email").val();
            var phone_num = $("#reg_phone_num").val();
            
            $.ajax({
                url:ajaxurl,
                method:"POST",
                data:{surname:surname,fname:fname,email:email,phone_num:phone_num,vacid:vacid,dataname:'reg_acct'},
                success:function(response){
                    $("#alert").html(response);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    $("#reg_acct").val('Create Account');
                    $("#alert").delay(4000).fadeOut();
                }
            });
        }
    });

    //Send eligibility test to existing user
    $("#send_link").click(function(){
        var email=$("#exist_email").val();
        var uid=$("#exist_phone").val();
        $("#busy_logo").show();
        $("#send_link").prop("disabled", true);
        $.ajax({
            url:ajaxurl,
            method:"POST",
            data:{vacid:vacid,email:email,uid:uid,dataname:'send_mail'},
            success:function(response){
                $("#msg_sent").html(response);
                $("#busy_logo").hide();
                setTimeout("window.location.href='../jobs.php';",6000);
            }
        });
    });
</script>