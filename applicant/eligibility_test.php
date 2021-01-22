<?php
require_once '../includes/db_conn.php';

$vacid = $_GET['vac'];
$uid = $_GET['uid'];
    if((!isset($vacid)) && (!isset($uid))){
        header("Location:../jobs.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eligibility Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3b8c65f5c7.js" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>  
</head>
<body style="background-color: #d3d3d3">

    <div class="container my-4">

        <div class="row">
            <div class="col-lg-5 mx-auto" id="alert">
            </div>
        </div>

        <div class="row" id="elig-div">
            <div class="col-lg-10 mx-auto rounded" id="login-box"  style="background: white">
                <h2 class="text-center mt-2">Job Eligibility Test</h2>
                <form action="" method="post" role="form" class="p-2" >
                    <?php
                    $data = '<table class="table table-borderless">
                    <tbody id="elig_test_form">';
                        $sq="SELECT * FROM eligibility_questions_tbl WHERE vacancy_id='$vacid'";
                        $stmt=$conn->query($sq);
                        while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
                        $data .= ' <tr>
                        <th><div class="form-group-sm form-group"><h5>'.$row['question'].'</h5></th>
                        <td><select name="question_option" id="'.$row['question_id'].'" class="form-control form-control-sm question_option" required><option value="">Select option</option><option value="1">Yes</option><option value="0">No</option></select></td>
                      </tr>';
                        }
                        $data .='</tbody>
                        </table>';
                        echo $data;
                    ?>
                    <div class="form-group form-group-sm">
                        <input type="checkbox" name="check_confirm" id="check_confirm">
                        <label for="check_confirm">I hereby affirm that all information provided here are correct</label>
                    </div>
                        <div class="form-group form-group-sm">
                            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-sm btn-primary mx-auto my-2 col-sm-4 float-right" disabled><br>
                        </div>
                </form> 
                <div class="form-group form-group-sm p-2">
                    <span id="succ_message"></span>
                    <button class="btn btn-sm btn-success col-sm-4 mx-auto my-2 float-right" id="next_page" disabled>Next</button> 
                </div>                  
            </div>
        </div>

        <div class="row" id="create-prof-div" style="display:none">
            <?php
                $sql="SELECT * FROM accounts_tbl WHERE uid='$uid'";
                $reslt=$conn->query($sql);
                $ret=$reslt->fetch(PDO::FETCH_ASSOC);

                $sql="SELECT * FROM "
            ?>
            <div class="col-lg-6 mx-auto rounded" id="login-box"  style="background: white">
                <h2 class="text-center mt-2">Create Profile</h2>
                <form action="" method="POST" role="form" class="p-2" id="register_form">
                        <div class="input-group-sm">
                            <label for="fname">First Name:</label>
                            <input type="text" name="fname" id="fname" value="<?=$ret['fname']?>" class="form-control" placeholder="First Name" disabled required>
                        </div>
                        <div class="input-group-sm">
                            <label for="lname">Last Name:</label>
                            <input type="text" name="lname" id="lname" value="<?=$ret['lname']?>" class="form-control" placeholder="Last Name" disabled required>
                        </div>
                        <div class="input-group-sm">
                            <label for="usermail">Email:</label>
                            <input type="email" value="<?=$ret['email']?>" name="usermail" id="usermail" class="form-control" placeholder="E-mail" disabled required>
                        </div>
                        <div class="input-group-sm">
                            <label for="phone_number">Phone Number:</label>
                            <input type="tel" name="phone_number" id="phone_number" value="<?=$ret['phone_number']?>" class="form-control" placeholder="Phone Number" disabled required>
                        </div>
                    
                        <div class="input-group-sm" id="pword-div" style="display:none">
                        <label for="reg_pass">Password:</label>
                            <input type="password" name="reg_pass" id="reg_pass" class="form-control" placeholder="Enter password" required minlength="8">
                            <small class="text-muted">Password must be at least 8 characters</small>
                        </div>
                        <div class="input-group-sm" id="cpword-div" style="display:none">
                        <label for="reg_cpass">Confirm Password:</label>
                            <input type="password" name="reg_cpass" id="reg_cpass" class="form-control" placeholder="Confirm password" required minlength="8">
                        </div>
                        


                        <div class="row mx-auto">
                            <div class="col m-2" id="login-div">
                                <div class="form-group mt-2">
                                    <input type="submit" name="login" id="login" value="Login" class="btn btn-primary btn-block">
                                </div>
                            </div> 

                            <div class="col m-2" id="reg-div">
                                <div class="form-group mt-2">
                                    <input type="submit" name="register" id="register" value="Register" class="btn btn-success btn-block">
                                </div>
                            </div> 
                        </div>   
                        <div class="row justify-content-center"><a href="" class="text-muted" id="bck" style=""><h5>Back</h5></a></div>                   
                    </form>                
            </div>
        </div>

    </div>


    
</body>
</html>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

<script>
var ajaxurl="applicant_control.php";
var vacid = '<?=$vacid?>';
var uid = '<?=$uid?>';
var app_page = 'apply.php?id='+vacid;

$("#check_confirm").click(function(){
    if($(this).is(':checked')){
        $("#submit").prop('disabled', false);
    }
    else{
        $("#submit").prop('disabled', true);
    }   
});

$("#submit").click(function(e){
    e.preventDefault();
    var response = [];
    $("#elig_test_form .question_option").each(function(){
        var ans = $(this).val();
        var qid = $(this).attr("id");
        var tmp_ans = {};
        tmp_ans.col1 = ans;
        tmp_ans.col2 = qid;
        response.push(tmp_ans);
    });
    var responses = JSON.stringify(response);
   
    $.ajax({
        type:"POST",
        url:ajaxurl,
        data:{vacid:vacid,uid:uid,responses:responses,dataname:'validate_elig'},
        success:function(data){
            if(data=='failed'){
                $("#alert").html('<div class="alert alert-danger"><h6>You do not meet the requirements to apply for this job</h6></div>');
                window.scrollTo({ top: 0, behavior: 'smooth' });
                $("#alert").delay(5000).fadeOut();
            }
            else if(data=='passed'){
                $("#succ_message").html('<div class="alert alert-success"><h6>You can continue to apply for the job</h6></div>');
                $("#succ_message").delay(4000).fadeOut();
                $("#next_page").prop('disabled', false);
                $("#next_page").focus();
            }
        }
    });

});

$("#next_page").click(function(){
    $("#elig-div").hide();
    $("#create-prof-div").show();
});    

//
$("#bck").click(function(e){
    e.preventDefault();  
    if($("#nxt_login").length){
        $("#nxt_login").attr("id", "login");
        $("#reg-div").show();
    }
    else if($("#nxt_reg").length){
        $("#nxt_reg").attr("id", "register");
        $("#cpword-div").hide();
        $("#login-div").show();

    }
});

//Validate and send ajax request to register user
var form = $("#register_form");

$(document).on("click", "#register", function(e){
        e.preventDefault();
        $("#login-div").hide();
        $("#pword-div, #cpword-div").show();
        $("#register").attr("id", "nxt_reg");
      
});

$(document).on("click", "#nxt_reg", function(e){
    e.preventDefault();

      $("#nxt_reg").val('Please Wait...');
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var usermail = $("#usermail").val();
        var phone = $("#phone_number").val();
        var reg_pass = $("#reg_pass").val();
        var reg_cpass = $("#reg_cpass").val();
        if(reg_cpass !== reg_pass){
            $("#alert").html('<div class="alert alert-danger"><h6>Passwords do not match</h6></div>');
            $("#alert").delay(5000).fadeOut();
            $("#nxt_reg").val('Register');
            return false;
        }
        else{
            $.ajax({
            url:ajaxurl,
            method:'POST',
            data:{fname:fname,lname:lname,uid:uid,usermail:usermail,phone:phone,reg_pass:reg_pass,reg_cpass:reg_cpass,dataname:'registration'},
            success:function(response){
                $("#alert").html(response);
                $("#alert").delay(5000).fadeOut();
                $("#nxt_reg").val('Register');
                window.scrollTo({ top: 0, behavior: 'smooth' });  
            }
        });
    }
});

$(document).on("click", "#login", function(e){
        e.preventDefault();
        $("#reg-div").hide();
        $("#pword-div").show();
        $("#login").attr("id", "nxt_login");
});

$(document).on("click", "#nxt_login", function(e){
    $("#alert").empty();
    if(form.valid()){
        e.preventDefault();
        $("#nxt_login").val('Please Wait...');
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var usermail = $("#usermail").val();
        var phone = $("#phone_number").val();
        var reg_pass = $("#reg_pass").val();

            $.ajax({
            url:ajaxurl,
            method:'POST',
            data:{fname:fname,lname:lname,uid:uid,usermail:usermail,phone:phone,reg_pass:reg_pass,dataname:'loginuser'},
            success:function(response){
                if(response==='successful'){
                    window.location=app_page;
                }else{
                    $("#alert").html(response);
                    $("#nxt_login").val('Login');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }                  
            }
        });
    }

});
</script>