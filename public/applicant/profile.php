<?php
require_once '../includes/applicant_header.php';
?>

<div class="container">
        <div class="row">
            <div class="col-lg-5 mt-3 mx-auto" id="alert">
            </div>
        </div>
    <div class="row justify-content-center">

        <div class="col-lg-6 mx-auto">
            <div class="card rounded mt-3">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#profile" data-toggle="tab" role="tab" class="nav-link active text-dark" >Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#edit_profile" data-toggle="tab" role="tab" class="nav-link text-dark">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#change_pass" data-toggle="tab" role="tab"class="nav-link text-dark">Change Password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">

                        <!-- profile tab content start -->
                        <div class="tab-pane container active" id="profile">
                                <div class="card">
                                    <div class="card-header text-center  text-secondary p-n5" style="background-color: #c0c0c0">
                                       User Profile
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text p-1 m-2 rounded" style="border: 1px solid #c0c0c0"> <strong>Name:
                                        </strong> <?= $user['lname']. ' '.$user['fname'].' '.$user['other_name']?></p>

                                        <p class="card-text p-1 m-2 rounded" style="border: 1px solid #c0c0c0"> <strong>Email:
                                        </strong> <?= $user['email']?></p>

                                        <p class="card-text p-1 m-2 rounded" style="border: 1px solid #c0c0c0"> <strong>Phone Number:
                                        </strong> <?= $user['phone_number']?></p>

                                        <p class="card-text p-1 m-2 rounded" style="border: 1px solid #c0c0c0"> <strong>Registered On:
                                        </strong> <?= date('d M Y', strtotime($user['date_created']))?></p>

                                    </div>
                                </div>
                        </div>

                        <!-- profile tab content end -->

                        <!-- Edit profile tab content start -->
                        <div class="tab-pane container fade" id="edit_profile">
                            <div class="card">
                                <div class="card-header text-center  text-secondary p-n5" style="background-color: #c0c0c0">
                                       Edit Profile
                                </div>
                                <form action="#" method="post" id="profile_update_form" class="px-2 mt-2">
                                    <div class="form-group">
                                        <label for="pr_surname" class="text-muted">Surname</label>
                                        <input type="text" name="pr_surname" id="pr_surname" value="<?=$user['lname']?>" class="form-control form-control-sm" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="location" class="text-muted">First Name</label>
                                        <input type="text" name="pr_fname" id="pr_fname" class="form-control form-control-sm" value="<?=$user['fname']?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="other_name" class="text-muted">Other Name</label>
                                        <input type="text" name="other_name" id="other_name" class="form-control form-control-sm" value="<?=$user['other_name']?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone_num" class="text-muted">Phone Number</label>
                                        <input type="text" name="phone_num" id="phone_num" class="form-control form-control-sm" value="<?=$user['phone_number']?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="text-muted">E-mail</label>
                                        <input type="text" name="email" id="email" class="form-control form-control-sm" value="<?=$user['email']?>" disabled>
                                    </div>

                                    <div class="form-group mt-2">
                                        <input type="submit" name="profile_update" value="Update Profile" class="btn btn-primary btn-block" id="upd_profile">
                                    </div>
                                </form>     
                            </div>                            
                        </div>
                        <!-- Edit profile tab content end -->


                        <!-- Change password tab content start -->
                        <div class="tab-pane container fade" id="change_pass">
                            <div class="card">
                                <div class="card-header text-center  text-secondary p-n5" style="background-color: #c0c0c0">
                                       Change Password
                                </div>
                                <form action="#" method="post" id="change_password_form" class="px-3 mt-2">
                                    <div class="form-group">
                                        <label for="curpass" class="text-muted">Enter Current Password</label>
                                        <input type="password" name="currpass" id="currpass" placeholder="Current Password" class="form-control form-control-sm" required minlength="8">
                                    </div>

                                    <div class="form-group">
                                        <label for="curpass" class="text-muted">Enter New Password</label>
                                        <input type="password" name="newpass" id="newpass" placeholder="New Password" class="form-control form-control-sm" required minlength="8">
                                    </div>

                                    <div class="form-group">
                                        <label for="curpass" class="text-muted">Enter New Password</label>
                                        <input type="password" name="cnewpass" id="cnewpass" placeholder="Confirm New Password" class="form-control form-control-sm" required minlength="8">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" name="changepass" value="Change Password" class="btn btn-success btn-block btn-lg" id="change_pass_btn">
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        <!-- Change password tab content end -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>

    var ajaxurl = "applicant_control.php";
    var uid = '<?=$user['uid']?>';

    $("#profile_update_form").click(function(){
        $("#alert").empty();
    });

    $("#change_password_form").click(function(){
        $("#alert").empty();
    });

    $("#upd_profile").click(function(e){
        e.preventDefault();
        var surname = $("#pr_surname").val();
        var fname = $("#pr_fname").val();
        var other_name = $("#other_name").val();
        var phone_num = $("#phone_num").val();
        var email = $("#email").val();
        

        $.ajax({
            url:ajaxurl,
            method:"POST",
            data:{surname:surname,fname:fname,other_name:other_name,phone_num:phone_num,email:email,uid:uid,dataname:'update_profile'},
            success:function(response){
                $("#alert").html(response);
                window.scrollTo({top: 0, behavior: 'smooth'});
            }
        });   
    });

    var change_password_form = $("#change_password_form");

    change_password_form.validate({
        rules:{
            cnewpass:{
                equalTo:"#newpass",
            }
        }
    });

    $("#change_pass_btn").click(function(e){
        e.preventDefault();

        if(change_password_form.valid()){
            var oldpass = $("#currpass").val();
            var newpass = $("#newpass").val();
            var cnewpass = $("#cnewpass").val();

            $.ajax({
                url:ajaxurl,
                method:"POST",
                data:{oldpass:oldpass,newpass:newpass,cnewpass:cnewpass,uid:uid,dataname:'update_password'},
                success:function(response){
                    $("#alert").html(response);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }  
            });        
        }
            

    });
</script>