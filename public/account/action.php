<?php
include "../includes/db_conn.php";

function generate_token($len=32){
    return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
}

extract($_POST);


if($dataname=='registeruser'){
   
    $pass=sha1($reg_pass);
    $cpass=sha1($reg_cpass);
    if($pass!=$cpass){
        echo '<div class="alert alert-danger">
                <h6>Passwords do not match</h6>
            </div>';  
        exit();
    }
    else{
        // $sql2="SELECT * FROM qualifications_tbl WHERE vacancy_id = '$vac_id'";
        // $result2 = $conn->query($sql2);
        // $qual = $result2->fetchAll();
        $sql = "SELECT email FROM job_users WHERE email='$usermail'";
        $result=$conn->query($sql);
        $row = $result->fetch();

        if($row['email']==$usermail){
            echo '<div class="alert alert-danger">
            <h6>Email already registered. <a class="text-info" href="login.php">click here</a> to login or <a class="text-info" href="forgotpass.php">click here</a> to reset your password </h6>
        </div>';
        }
        else{
            $sql = "SELECT MAX(id) AS maximum FROM job_users";
            $result=$conn->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $old_uid = $row['maximum'];
            if(empty($old_uid)){
                $uid = 1;
            }
            else{
                $uid = $old_uid + 1;
            }

            $token = generate_token(20);
            $stmt=$conn->prepare("INSERT INTO job_users(fname, lname, email, phone_number, password, date_created, token, active, uid) VALUES (?,?,?,?,?,?,?,?,?)");
            $status = '0';
            $regdate = date("Y-m-d H:i:s");
            
            $stmt->bindParam(1, $fname, PDO::PARAM_STR);
            $stmt->bindParam(2, $lname, PDO::PARAM_STR);
            $stmt->bindParam(3, $usermail, PDO::PARAM_STR);
            $stmt->bindParam(4, $phone, PDO::PARAM_STR);
            $stmt->bindParam(5, $pass, PDO::PARAM_STR);
            $stmt->bindParam(6, $regdate, PDO::PARAM_STR);
            $stmt->bindParam(7, $token, PDO::PARAM_STR);
            $stmt->bindParam(8, $status, PDO::PARAM_INT); 
            $stmt->bindParam(9, $uid, PDO::PARAM_INT);         
            $result = $stmt->execute();

            if(isset($result)){
            $subject = '<h3>User registration</h3> <br>';
            $txt = "Follow the link below to activate your account: <br> <a href='http://localhost/jobportal/account/verification.php?email=$usermail&token=$token'>Click here</a>to activate your account<br>Regards";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= "From: penl.com.ng" . "\r\n";
            $headers .= 'Reply-To: penl.com.ng' . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();            
            $activate=mail($usermail,$subject,$txt, $headers);

            if(isset($activate)){
                echo '<div class="alert alert-success">
                <h6>Registration Successful. Check your mail to confirm your account now</h6>
            </div>';
            }else{
                echo '<div class="alert alert-danger">
                <h6>Activation mail not sent,please hold on</h6>
            </div>';                
            }
            }
            else{
                echo '<div class="alert alert-danger">
                <h6>Something went wrong. Please try again</h6>
            </div>';
            }
        }
    }
    


}

if($dataname=='userlogin'){
    session_start();
    $passwrd=sha1($pass);

    $sql = "SELECT * FROM job_users WHERE email='$email' AND password='$passwrd'";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
     
    if($result->rowCount() > 0){
        $_SESSION['user'] = $row['email'];
        $chk_active = (int) $row['active'];
        if($chk_active == '0'){
            echo '<div class="alert alert-danger">
                <h6>Please check your mail to activate your account</h6>
            </div>';
        }else{
            echo 'successful';
        }
    }
    else{
        echo '<div class="alert alert-danger">
            <h6>Wrong Login details! Please check Email and Pasword</h6>
        </div>';
    }


}

if($dataname=='resetpass'){
    $sql = "SELECT * FROM job_users WHERE email='$email'";
    $result = $conn->query($sql);
    $reslt = $result->fetch();
    if($result->rowCount() > 0){
        // echo '<div class="alert alert-success">
        // <h6>Mail exists</h6>
        // </div>';
        $token = generate_token(20);
        $sql2 = "UPDATE job_users SET token='$token', token_expire=DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email='$email'";
        $stmt = $conn->query($sql);

        if(isset($stmt)){
            $subject = '<h3>Password Reset</h3>';
            $txt = "Follow the link below to reset your password: <a href='http://localhost/jobportal/account/passwordreset.php?email=$email&token=$token'>Click here</a>to reset your password<br>Regards";            
            $activate=mail($usermail,$subject,$txt, $headers);
            
            if(isset($activate)){
                echo '<div class="alert alert-success">
                    <h6>Check your mail for password reset details</h6>
                </div>';
            }else{
                echo '<div class="alert alert-danger">
                    <h6>Password reset mail not sent please hold on</h6>
                </div>';                
            }
            }
            else{
                echo '<div class="alert alert-danger">
                    <h6>Something went wrong. Please try again</h6>
                </div>';
            }

    }
    else{
        echo '<div class="alert alert-danger">
        <h6>Mail doesn\'t exist</h6>
        </div>';
    }
}

if($dataname=='reg_acct'){
    // print_r($_POST);
    $sql="SELECT * FROM accounts_tbl WHERE email='$email' OR phone_number='$phone_num'";
    $result=$conn->query($sql);
    $row=$result->fetch(PDO::FETCH_ASSOC);
    if($result->rowCount() > 0){
        echo '<div class="alert alert-danger">
                <h6>You already have an account, go back to confirm your account</h6>
              </div>';
    }else{
        $sql="SELECT MAX(uid) AS maximum FROM accounts_tbl";
        $reslt = $conn->query($sql);
        $row = $reslt->fetch(PDO::FETCH_ASSOC);
        $old_uid = $row['maximum'];
        if(empty($old_uid)){
            $uid = 1;
        }else {
            $uid = $old_uid + 1;
        }

        $stmt=$conn->prepare("INSERT INTO accounts_tbl(lname, fname, email, phone_number) VALUES (?,?,?,?)");
        $stmt->bindParam(1, $surname, PDO::PARAM_STR);
        $stmt->bindParam(2, $fname, PDO::PARAM_STR);
        $stmt->bindParam(3, $email, PDO::PARAM_STR);
        $stmt->bindParam(4, $phone_num, PDO::PARAM_STR);
        $result = $stmt->execute();

        $sq2 = "SELECT *, posts.type AS position FROM job_vacancy_tbl JOIN posts ON job_vacancy_tbl.post_id=posts.typ WHERE vacancy_id='$vacid'";
        $reslt = $conn->query($sq2);
        $ret = $reslt->fetch(PDO::FETCH_ASSOC);
        $post = $ret['position'];

        if(isset($result)){
           
            $subject = '<h3>Job Eligibility Test Invite</h3> <br>';
            $link = "http://localhost/jobportal/applicant/eligibility_test.php?uid=$uid&vac=$vacid";
            $txt = "Follow the link below to take the eligibility test for this position (".$post.") you wish to apply for: <br> <a href=".$link.">Click here</a>to take the test<br>Goodluck";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();            
            $sendmail=mail($email,$subject,$txt,$headers);

            if(isset($sendmail)){
                echo '<div class="alert alert-success">
                <h6>Registration Successful. Check your mail for the link to take the eligibility test</h6>
            </div>';
            }
            else{
                echo '<div class="alert alert-danger">
                <h6>Something went wrong. Please try again</h6>
            </div>';
            }
        }
        else{
            echo '<div class="alert alert-danger">
                <h6>Something went wrong. Please try to register again</h6>
            </div>';
        }
    }
}

if($dataname=='confirm_acct'){
    $sq = "SELECT * FROM accounts_tbl WHERE email='$email' AND phone_number='$phone_num'";
    $reslt=$conn->query($sq);
    $ret=$reslt->fetch(PDO::FETCH_ASSOC);
    if($reslt->rowCount() > 0){
        $data['record'] = 'yes';
        $data['name'] = $ret['lname'].' '.$ret['fname'];
        $data['email'] = $ret['email'];
        $data['phone_num'] = $ret['phone_number'];
        $data['uid'] = $ret['uid'];
    }
    else{
        $data['record'] = 'no';
        $data['msg'] = '<div class="alert alert-danger">
                            <h6>Account does not exist, please check details</h6>
                        </div>';
    } 

    echo json_encode($data);
}

if($dataname=='send_mail'){
        $sq2 = "SELECT *, posts.type AS position FROM job_vacancy_tbl JOIN posts ON job_vacancy_tbl.post_id=posts.typ WHERE vacancy_id='$vacid'";
        $reslt = $conn->query($sq2);
        $ret = $reslt->fetch(PDO::FETCH_ASSOC);
        $post = $ret['position'];

            $subject = '<h3>Job Eligibility Test Invite</h3> <br>';
            $link = "http://localhost/jobportal/applicant/eligibility_test.php?uid=$uid&vac=$vacid";
            $txt = "Follow the link below to take the eligibility test for this position (".$post.") you wish to apply for: <br> <a href=".$link.">Click here</a>to take the test<br>Goodluck";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();            
            $sendmail=mail($email,$subject,$txt,$headers);

            if(isset($sendmail)){
                echo '<div class="alert alert-success">
                <h6>A message has been sent to your mail, you are required to click the link in the mail to continue</h6>
            </div>';
            }
            else{
                echo '<div class="alert alert-danger">
                <h6>Something went wrong. Please try again</h6>
            </div>';
            }
}

?>