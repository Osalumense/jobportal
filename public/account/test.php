<?php
include "../includes/db_conn.php";
    $uid = '6';
    $vacid = 'V-20-09-003';

    // $link = "http://localhost/jobportal/applicant/eligibility_test.php?uid=$uid&vac=$vacid";
    //         $txt = "Follow the link below to take the eligibility test for this position you wish to apply for: <br> <a href=".$link.">Click here</a> to continue. <br>Goodluck";
    //     echo $txt;
    $stmt=$conn->prepare("INSERT INTO job_users(uid, fname, lname, email, phone_number, password, date_created, active) VALUES (?,?,?,?,?,?,?,?)");
    $status = '1';
    $regdate = date("Y-m-d H:i:s");

    $stmt->bindParam(1, $uid, PDO::PARAM_INT);
    $stmt->bindParam(2, $fname, PDO::PARAM_STR);
    $stmt->bindParam(3, $lname, PDO::PARAM_STR);
    $stmt->bindParam(4, $usermail, PDO::PARAM_STR);
    $stmt->bindParam(5, $phone, PDO::PARAM_STR);
    $stmt->bindParam(6, $pass, PDO::PARAM_STR);
    $stmt->bindParam(7, $regdate, PDO::PARAM_STR);
    $stmt->bindParam(8, $status, PDO::PARAM_INT);      
    $result = $stmt->execute();
    if(isset($result)){
        echo '<div class="alert alert-success">
        <h6>Registration Successful. You can go ahead to apply for the vacancy</h6>
    </div>';
    }else{
        echo '<div class="alert alert-danger">
        <h6>Error! Please try again</h6>
    </div>';                
    }
?>