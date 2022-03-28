<?php
include "../includes/db_conn.php";

extract($_POST);
if($dataname=='getempdet'){
    $sql = "SELECT *, posts.type AS position, 
    employmenttype.type AS emptype, 
    employmentcategory.type AS empcat
    FROM job_vacancy_tbl 
    JOIN employmentcategory ON job_vacancy_tbl.vacancy_category_id=employmentcategory.id
    JOIN employmenttype ON job_vacancy_tbl.employment_type=employmenttype.id
    JOIN departments ON job_vacancy_tbl.department_id=departments.id
    JOIN posts ON job_vacancy_tbl.post_id=posts.id
    WHERE vacancy_id='$id'";
    

    $result = $conn->query($sql);
    $searchrow = $result->fetchAll();
    foreach($searchrow as $row){
                        $tabval = '<div class="tab-pane fade container show active" id="'.$row["vacancy_id"].'" role="tabpanel">
                        <div class="row">
                            <!--<div class="col-md-4 col-sm-6">
                                <h5 class="">Vacancy Details:</h5>
                            </div>-->
                            <div class="col-md-9 col-sm-12">
                                <h5><span class="font-weight-lighter">Position: </span>'.ucfirst($row["position"]).'</h5>
                            </div>
                            <div class="col-md-3 col-sm">
                                <a href="apply.php?uid='.$uid.'&vac='.$row["vacancy_id"].'"><button class="btn btn-sm btn-outline-info float-right" id="show_job">Apply Now</button></a>
                            </div>
                            
                        </div>

                        <div class="row justify-content-center mt-2">
                            <div class="col-md-4 col-sm-6">
                                <p>Category: <span class="lead">'.$row["empcat"].'</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <p>Employment Type: <span class="lead">'.$row["emptype"].'</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <p>Department: <span class="lead">'.$row["dept"].'</span></p>
                            </div>                        
                        </div>
                        
                        <div class="row justify-content-center">
                            <div class="col-md-4 col-sm-6">
                                <p>Valid until: <span class="lead">'.$row["closing_date"].'</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <p>Location: <span class="lead">'.$row["job_location"].'</span></p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <p>Salary: <span class="lead">'.$row["salary"].'</span></p>
                            </div>                        
                        </div>                      
                        
                        
                        
                        <p>Job Summary: <span class="lead">'.$row["job_summary"].'</span></p>
                        <p>Experience level: <span class="lead">'.$row["experience_level"].'</span></p>

                        <div class="row justify-content-center">
                            <div class="col">
                                <p>Minimum requirements: </p> <ol><span class="lead">';
                                
                                $sql2="SELECT * FROM qualifications_tbl WHERE vacancy_id = '$id'";
                                $result2 = $conn->query($sql2);
                                $qual = $result2->fetchAll();
                                foreach($qual as $qrow){
                                    $tabval.= '<li>'.$qrow["qualification"].'</li>';
                                }

                                $tabval.=' </span></ol>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col">
                                <p>Job Description:</p>
                                <ol><span class="lead">';

                                $sql3="SELECT * FROM vacancy_desc_tbl WHERE vacancy_id = '$id'";
                                $result3 = $conn->query($sql3);
                                $job = $result3->fetchAll();
                                foreach($job as $jrow){
                                    $tabval.= '<li>'.$jrow["job_description"].'</li>';
                                }

                                $tabval .='</span></ol>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <a href="apply.php?uid='.$uid.'&vac='.$row["vacancy_id"].'"><button class="btn btn-sm btn-outline-info my-3" id="show_job">Apply Now</button></a>
                        </div>                  
                    <hr>
                </div>';
                }
                    
        $navdetails['tabval']=$tabval;
        echo json_encode($navdetails);

}

if($dataname=='showvacancies'){
    $current_date = date('Y-m-d');
    $sql = "SELECT * FROM employmentcategory";
    $result = $conn->query($sql);
    $cats = $result->fetchAll();
    $catdisplay = '';
    
    foreach($cats as $jrow){
        $jobtype=$jrow["id"];
        $catdisplay .= '<h5 class="mx-auto">'.$jrow["type"].'</h5>';
    
        $sql2="SELECT *, posts.type AS emptype FROM job_vacancy_tbl LEFT JOIN posts ON job_vacancy_tbl.post_id=posts.id WHERE (vacancy_category_id='$jobtype') AND ('$current_date' BETWEEN creation_date AND closing_date)";
        $result2 = $conn->query($sql2);
        $posts = $result2->fetchAll();
        
        
        foreach($posts as $prow){
            if($result2->rowCount() > 0){
                $catdisplay .= '<a class="nav-link links" id="'.$prow["vacancy_id"].'" data-toggle="pill" href="#'.$prow["vacancy_id"].'" role="tab">'.$prow["emptype"].'</a>'; 
            }
            else{
                $catdisplay .= '<p> No vacancies available </p>';
            }
        }
    }
    
    $jobs['catdisplay']=$catdisplay;
    echo json_encode($jobs);
}

if($dataname=='showlga'){
    $sql="SELECT * FROM lga WHERE state_id ='$stateid'";
    $result=$conn->query($sql);
    while($row = $result->fetch()){  
        echo '<option value="'.$row['lga_id'].'">'.$row['lga_name'].'</option>'; 
	}

}


//Control to submit job application details
if($dataname=='submitapplication'){
    //print_r($_POST);
    
    //select details from job_vacancy_tbl
    $sql2="SELECT * FROM job_vacancy_tbl WHERE vacancy_id='$id'";
    $result2=$conn->query($sql2);
    $row2 = $result2->fetch();
    
    $vacancy_category=$row2['vacancy_category_id'];
    $emp_type=$row2['employment_type'];
    $dept_id=$row2['department_id'];
    $post_id=$row2['post_id'];


        //check if user has previously saved applications in job_applicants_tbl
        $sql4="SELECT * FROM job_applicants_tbl WHERE (vacancy_id='$id' AND uid='$uid') AND (submit_status='incomplete')";
        $result4=$conn->query($sql4);
        $row = $result4->fetch();
        $cv_name = '';
        $application_date = date("Y-m-d");
        $submit_stat = 'submitted'; 

        
        if($result4->rowCount() > 0){

                    $app_id = $row['applicant_id'];

                    //Save uploaded files
                    if(empty($_FILES["cv"])){ 
                        $cv_name .= $row['cv_upload'];       
                    }else{
                        $cv = $_FILES["cv"]["name"];
                        $target_dir="cv_uploads/";
                        $fileExt = strtolower(pathinfo($cv,PATHINFO_EXTENSION));
                        if($fileExt != 'pdf'){
                            echo '<div class="alert alert-danger">
                            <h6>Please upload your CV in PDF format</h6>
                            </div>';
                        exit();
                        }  
                        else{  
                            $cv_name .= $app_id.'.'.$fileExt;
                            $filenamearr=explode(".", $_FILES["cv"]["name"]);
                            move_uploaded_file($_FILES["cv"]["tmp_name"],$target_dir.$cv_name);
                        }                 
                    }

                    $delete1 = "DELETE FROM educational_history_tbl WHERE vacancy_id='$id' AND applicant_id='$app_id'";
                    $stmt = $conn->query($delete1);

                    $delete2 = "DELETE FROM referees_tbl WHERE vacancy_id='$id' AND applicant_id='$app_id'";
                    $stmt = $conn->query($delete2);

                    $delete3 = "DELETE FROM workexperience_tbl WHERE vacancy_id='$id' AND applicant_id='$app_id'";
                    $stmt = $conn->query($delete3);
        
                    $update = "UPDATE job_applicants_tbl SET title='$title', surname='$surname', first_name='$fname', other_name='$other_name', sex='$gender', dob='$dob', marital_status='$m_status', nationality='$nationality', state_of_origin='$state_of_origin', lga='$lga', hometown='$hometown', phone_number='$phone1', alt_phone_number='$phone2', email='$email', street='$address', city='$city', state_of_residence='$state_of_residence', cv_upload='$cv_name', submit_status='$submit_stat', application_date='$application_date', application_message='$application_message' WHERE vacancy_id='$id' AND applicant_id='$app_id'";
                    $stmt = $conn->query($update);
        
                    $educ_detail=json_decode($educ_details, true);
                    foreach($educ_detail as $educ_entry){
                        $institution = $educ_entry['col1'];
                        $school_location = $educ_entry['col2'];
                        $from = $educ_entry['col3'];
                        $to = $educ_entry['col4'];
                        $course = $educ_entry['col5'];
                        $degree = $educ_entry['col6'];
                        $class_degree = $educ_entry['col7'];
        
                        $stmt2 = $conn->prepare("INSERT INTO educational_history_tbl(applicant_id, vacancy_id, institution, location, start_date, end_date, course, degree, class_of_degree) VALUES (?,?,?,?,?,?,?,?,?)");
                        $stmt2->bindParam(1, $app_id, PDO::PARAM_INT);
                        $stmt2->bindParam(2, $id, PDO::PARAM_STR);
                        $stmt2->bindParam(3, $institution, PDO::PARAM_STR);
                        $stmt2->bindParam(4, $school_location, PDO::PARAM_STR);
                        $stmt2->bindParam(5, $from, PDO::PARAM_STR);
                        $stmt2->bindParam(6, $to, PDO::PARAM_STR);
                        $stmt2->bindParam(7, $course, PDO::PARAM_STR);
                        $stmt2->bindParam(8, $degree, PDO::PARAM_STR);
                        $stmt2->bindParam(9, $class_degree, PDO::PARAM_STR);
                        $stmt2->execute();
                    }
        
                    $ref_detail=json_decode($ref_details, true);
                    foreach($ref_detail as $ref_entry){
                        $ref_title = $ref_entry['col1'];
                        $ref_surname = $ref_entry['col2'];
                        $ref_othername = $ref_entry['col3'];
                        $ref_phone = $ref_entry['col4'];
                        $ref_mail = $ref_entry['col5'];
                        $ref_org = $ref_entry['col6'];
                        $ref_designation = $ref_entry['col7'];
        
                        $stmt3 = $conn->prepare("INSERT INTO referees_tbl(applicant_id, vacancy_id, title, surname, other_names, organization, designation, phone_number, email) VALUES (?,?,?,?,?,?,?,?,?)");
                        $stmt3->bindParam(1, $app_id, PDO::PARAM_INT);
                        $stmt3->bindParam(2, $id, PDO::PARAM_STR);
                        $stmt3->bindParam(3, $ref_title, PDO::PARAM_STR);
                        $stmt3->bindParam(4, $ref_surname, PDO::PARAM_STR);
                        $stmt3->bindParam(5, $ref_othername, PDO::PARAM_STR);
                        $stmt3->bindParam(6, $ref_org, PDO::PARAM_STR);
                        $stmt3->bindParam(7, $ref_designation, PDO::PARAM_STR);
                        $stmt3->bindParam(8, $ref_phone, PDO::PARAM_STR);
                        $stmt3->bindParam(9, $ref_mail, PDO::PARAM_STR);
                        $stmt3->execute();
                    }
        
                    $wrk_detail=json_decode($wrk_details, true);
                    foreach($wrk_detail as $wrk_entry){
                        $organization = $wrk_entry['col1'];
                        $position = $wrk_entry['col2'];
                        $from = $wrk_entry['col3'];
                        $to = $wrk_entry['col4'];
                        $reason = $wrk_entry['col5'];
                        $prev_salary = $wrk_entry['col6'];
        
                        $stmt4 = $conn->prepare("INSERT INTO workexperience_tbl(applicant_id, vacancy_id, organization, start_date, end_date, position_held, reason_for_leaving, salary) VALUES (?,?,?,?,?,?,?,?)");
                        $stmt4->bindParam(1, $app_id, PDO::PARAM_INT);
                        $stmt4->bindParam(2, $id, PDO::PARAM_STR);
                        $stmt4->bindParam(3, $organization, PDO::PARAM_STR);
                        $stmt4->bindParam(4, $from, PDO::PARAM_STR);
                        $stmt4->bindParam(5, $to, PDO::PARAM_STR);
                        $stmt4->bindParam(6, $position, PDO::PARAM_STR);
                        $stmt4->bindParam(7, $reason, PDO::PARAM_STR);
                        $stmt4->bindParam(8, $prev_salary, PDO::PARAM_STR);
                        $result=$stmt4->execute();
                    }
                    
                    if(isset($result)){
                        echo '<div class="alert alert-success">
                        <h6>You have successfully applied for the job. Keep checking your profile for updates</h6>
                        </div>';            
                    }
                    else{
                        echo '<div class="alert alert-danger">
                    <h6>There was an error, please try again</h6>
                    </div>';            
                    }
                

        }
            else{
            
                //check the max of the applicant_id and create new applicant_id
                $sql="SELECT MAX(applicant_id) AS maximum FROM job_applicants_tbl";
                $result = $conn->query($sql);
                $row = $result->fetch();
                $old_app_id = $row['maximum'];
                if(empty($old_app_id)){
                    $app_id = 1;
                }else {
                    $app_id = $old_app_id + 1;
                }

                    //Save uploaded files
                    $cv = $_FILES["cv"]["name"];
                    $target_dir="cv_uploads/";
                    $fileExt = strtolower(pathinfo($cv,PATHINFO_EXTENSION));
                    if($fileExt != 'pdf'){
                        echo '<div class="alert alert-danger">
                        <h6>Please upload your CV in PDF format</h6>
                        </div>';
                    exit();
                    }  
                    else{  
                        $cv_name .= $app_id.'.'.$fileExt;
                        $filenamearr=explode(".", $_FILES["cv"]["name"]);
                        move_uploaded_file($_FILES["cv"]["tmp_name"],$target_dir.$cv_name);
                    }                                

                //Insert values into the job_applicants_tbl        
                $stmt=$conn->prepare("INSERT INTO job_applicants_tbl(applicant_id, uid, vacancy_category_id, vacancy_id, employment_type, department_id, position_id, title, surname, first_name, other_name, sex, dob, marital_status, nationality, state_of_origin, lga, hometown, phone_number, alt_phone_number, email, street, city, state_of_residence, cv_upload, application_message, application_date, submit_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $stmt->bindParam(1, $app_id, PDO::PARAM_INT);
                $stmt->bindParam(2, $uid, PDO::PARAM_INT);
                $stmt->bindParam(3, $vacancy_category, PDO::PARAM_INT);
                $stmt->bindParam(4, $id, PDO::PARAM_STR);
                $stmt->bindParam(5, $emp_type, PDO::PARAM_INT);
                $stmt->bindParam(6, $dept_id, PDO::PARAM_INT);
                $stmt->bindParam(7, $post_id, PDO::PARAM_INT);
                $stmt->bindParam(8, $title, PDO::PARAM_STR);
                $stmt->bindParam(9, $surname, PDO::PARAM_STR);
                $stmt->bindParam(10, $fname, PDO::PARAM_STR);
                $stmt->bindParam(11, $other_name, PDO::PARAM_STR);
                $stmt->bindParam(12, $gender, PDO::PARAM_STR);
                $stmt->bindParam(13, $dob, PDO::PARAM_STR);
                $stmt->bindParam(14, $m_status, PDO::PARAM_STR);
                $stmt->bindParam(15, $nationality, PDO::PARAM_STR);
                $stmt->bindParam(16, $state_of_origin, PDO::PARAM_STR);
                $stmt->bindParam(17, $lga, PDO::PARAM_STR);
                $stmt->bindParam(18, $hometown, PDO::PARAM_STR);
                $stmt->bindParam(19, $phone1, PDO::PARAM_STR);
                $stmt->bindParam(20, $phone2, PDO::PARAM_STR);
                $stmt->bindParam(21, $email, PDO::PARAM_STR);
                $stmt->bindParam(22, $address, PDO::PARAM_STR);
                $stmt->bindParam(23, $city, PDO::PARAM_STR);
                $stmt->bindParam(24, $state_of_residence, PDO::PARAM_STR);
                $stmt->bindParam(25, $cv_name, PDO::PARAM_STR);
                $stmt->bindParam(26, $application_message, PDO::PARAM_STR);
                $stmt->bindParam(27, $application_date, PDO::PARAM_STR);
                $stmt->bindParam(28, $submit_stat, PDO::PARAM_STR);
                $stmt->execute();

                //Enter referee details into referees_tbl
                $ref_detail=json_decode($ref_details, true);
                foreach($ref_detail as $ref_entry) {
                    $ref_title = $ref_entry['col1'];
                    $ref_surname = $ref_entry['col2'];
                    $ref_othername = $ref_entry['col3'];
                    $ref_phone = $ref_entry['col4'];
                    $ref_mail = $ref_entry['col5'];
                    $ref_org = $ref_entry['col6'];
                    $ref_designation = $ref_entry['col7'];  
                    $stmt2 = $conn->prepare("INSERT INTO referees_tbl(applicant_id, vacancy_id, title, surname, other_names, organization, designation, phone_number, email) VALUES (?,?,?,?,?,?,?,?,?)");
                    $stmt2->bindParam(1, $app_id, PDO::PARAM_INT);
                    $stmt2->bindParam(2, $id, PDO::PARAM_STR);
                    $stmt2->bindParam(3, $ref_title, PDO::PARAM_STR);
                    $stmt2->bindParam(4, $ref_surname, PDO::PARAM_STR);
                    $stmt2->bindParam(5, $ref_othername, PDO::PARAM_STR);
                    $stmt2->bindParam(6, $ref_org, PDO::PARAM_STR);
                    $stmt2->bindParam(7, $ref_designation, PDO::PARAM_STR);
                    $stmt2->bindParam(8, $ref_phone, PDO::PARAM_STR);
                    $stmt2->bindParam(9, $ref_mail, PDO::PARAM_STR);
                    $stmt2->execute();                             
                }

                //Enter educational history details into educational_history_tbl
                $educ_detail=json_decode($educ_details, true);
                foreach($educ_detail as $educ_entry){
                    $institution = $educ_entry['col1'];
                    $school_location = $educ_entry['col2'];
                    $from = $educ_entry['col3'];
                    $to = $educ_entry['col4'];
                    $course = $educ_entry['col5'];
                    $degree = $educ_entry['col6'];
                    $class_degree = $educ_entry['col7'];

                    $stmt3 = $conn->prepare("INSERT INTO educational_history_tbl(applicant_id, vacancy_id, institution, location, start_date, end_date, course, degree, class_of_degree) VALUES (?,?,?,?,?,?,?,?,?)");
                    $stmt3->bindParam(1, $app_id, PDO::PARAM_INT);
                    $stmt3->bindParam(2, $id, PDO::PARAM_STR);
                    $stmt3->bindParam(3, $institution, PDO::PARAM_STR);
                    $stmt3->bindParam(4, $school_location, PDO::PARAM_STR);
                    $stmt3->bindParam(5, $from, PDO::PARAM_STR);
                    $stmt3->bindParam(6, $to, PDO::PARAM_STR);
                    $stmt3->bindParam(7, $course, PDO::PARAM_STR);
                    $stmt3->bindParam(8, $degree, PDO::PARAM_STR);
                    $stmt3->bindParam(9, $class_degree, PDO::PARAM_STR);
                    $stmt3->execute();
                }

                //Enter work experience details into work_experience_tb;
                $wrk_detail=json_decode($wrk_details, true);
                foreach($wrk_detail as $wrk_entry){
                    $organization = $wrk_entry['col1'];
                    $position = $wrk_entry['col2'];
                    $from = $wrk_entry['col3'];
                    $to = $wrk_entry['col4'];
                    $reason = $wrk_entry['col5'];
                    $prev_salary = $wrk_entry['col6'];

                    $stmt4 = $conn->prepare("INSERT INTO workexperience_tbl(applicant_id, vacancy_id, organization, start_date, end_date, position_held, reason_for_leaving, salary) VALUES (?,?,?,?,?,?,?,?)");
                    $stmt4->bindParam(1, $app_id, PDO::PARAM_INT);
                    $stmt4->bindParam(2, $id, PDO::PARAM_STR);
                    $stmt4->bindParam(3, $organization, PDO::PARAM_STR);
                    $stmt4->bindParam(4, $from, PDO::PARAM_STR);
                    $stmt4->bindParam(5, $to, PDO::PARAM_STR);
                    $stmt4->bindParam(6, $position, PDO::PARAM_STR);
                    $stmt4->bindParam(7, $reason, PDO::PARAM_STR);
                    $stmt4->bindParam(8, $prev_salary, PDO::PARAM_STR);
                    $final_result=$stmt4->execute();
                }
                if(isset($final_result)){
                    echo '<div class="alert alert-success">
                    <h6>You have successfully applied for the job</h6>
                    </div>';
               }
               else{
                   echo '<div class="alert alert-danger">
                   <h6>There was an error, please try again</h6>
                   </div>';
               }
            }
}

//Control to save applicants details for later
if($dataname=='save_for_later'){
    $sql = "SELECT * FROM job_applicants_tbl WHERE (vacancy_id='$id' AND uid='$uid') AND (submit_status='incomplete')";
    $result=$conn->query($sql);
    $row = $result->fetch();  
    $cv_name = '';  
  
    if($result->rowCount() > 0){

        $app_id = $row['applicant_id'];

        //Save uploaded files
        if(empty($_FILES["cv"])){ 
            $cv_name .= $row['cv_upload'];       
        }else{
            $cv = $_FILES["cv"]["name"];
            $target_dir="cv_uploads/";
            $fileExt = strtolower(pathinfo($cv,PATHINFO_EXTENSION));
            if($fileExt != 'pdf'){
                echo '<div class="alert alert-danger">
                <h6>Please upload your CV in PDF format</h6>
                </div>';
            exit();
            }  
            else{  
                $cv_name .= $app_id.'.'.$fileExt;
                $filenamearr=explode(".", $_FILES["cv"]["name"]);
                move_uploaded_file($_FILES["cv"]["tmp_name"],$target_dir.$cv_name);
            }                 
        }

        $update = "UPDATE job_applicants_tbl SET title='$title', surname='$surname', first_name='$fname', other_name='$other_name', sex='$gender', dob='$dob', marital_status='$m_status', nationality='$nationality', state_of_origin='$state_of_origin', lga='$lga', hometown='$hometown', phone_number='$phone1', alt_phone_number='$phone2', email='$email', street='$address', city='$city', state_of_residence='$state_of_residence', cv_upload='$cv_name', application_message='$application_message' WHERE vacancy_id='$id' AND applicant_id='$app_id'";
        $stmt = $conn->query($update);

            
        $delete1 = "DELETE FROM educational_history_tbl WHERE vacancy_id='$id' AND applicant_id='$app_id'";
        $stmt = $conn->query($delete1);

        $delete2 = "DELETE FROM referees_tbl WHERE vacancy_id='$id' AND applicant_id='$app_id'";
        $stmt = $conn->query($delete2);

        $delete3 = "DELETE FROM workexperience_tbl WHERE vacancy_id='$id' AND applicant_id='$app_id'";
        $stmt = $conn->query($delete3);

        $educ_detail=json_decode($educ_details, true);
        foreach($educ_detail as $educ_entry){
            $institution = $educ_entry['col1'];                $school_location = $educ_entry['col2'];
            $from = $educ_entry['col3'];
            $to = $educ_entry['col4'];
            $course = $educ_entry['col5'];
            $degree = $educ_entry['col6'];
            $class_degree = $educ_entry['col7'];

            $stmt2 = $conn->prepare("INSERT INTO educational_history_tbl(applicant_id, vacancy_id, institution, location, start_date, end_date, course, degree, class_of_degree) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt2->bindParam(1, $app_id, PDO::PARAM_INT);
            $stmt2->bindParam(2, $id, PDO::PARAM_STR);
            $stmt2->bindParam(3, $institution, PDO::PARAM_STR);
            $stmt2->bindParam(4, $school_location, PDO::PARAM_STR);
            $stmt2->bindParam(5, $from, PDO::PARAM_STR);    
            $stmt2->bindParam(6, $to, PDO::PARAM_STR);
            $stmt2->bindParam(7, $course, PDO::PARAM_STR);
            $stmt2->bindParam(8, $degree, PDO::PARAM_STR);
            $stmt2->bindParam(9, $class_degree, PDO::PARAM_STR);
            $stmt2->execute();
        }
        
        $ref_detail=json_decode($ref_details, true);
        foreach($ref_detail as $ref_entry){
            $ref_title = $ref_entry['col1'];
            $ref_surname = $ref_entry['col2'];
            $ref_othername = $ref_entry['col3'];
            $ref_phone = $ref_entry['col4'];
            $ref_mail = $ref_entry['col5'];
            $ref_org = $ref_entry['col6'];
            $ref_designation = $ref_entry['col7'];

            $stmt3 = $conn->prepare("INSERT INTO referees_tbl(applicant_id, vacancy_id, title, surname, other_names, organization, designation, phone_number, email) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt3->bindParam(1, $app_id, PDO::PARAM_INT);
            $stmt3->bindParam(2, $id, PDO::PARAM_STR);
            $stmt3->bindParam(3, $ref_title, PDO::PARAM_STR);
            $stmt3->bindParam(4, $ref_surname, PDO::PARAM_STR);
            $stmt3->bindParam(5, $ref_othername, PDO::PARAM_STR);
            $stmt3->bindParam(6, $ref_org, PDO::PARAM_STR);
            $stmt3->bindParam(7, $ref_designation, PDO::PARAM_STR);
            $stmt3->bindParam(8, $ref_phone, PDO::PARAM_STR);
            $stmt3->bindParam(9, $ref_mail, PDO::PARAM_STR);
            $stmt3->execute();
        }

        
        $wrk_detail=json_decode($wrk_details, true);
        foreach($wrk_detail as $wrk_entry){
            $organization = $wrk_entry['col1'];
            $position = $wrk_entry['col2'];
            $from = $wrk_entry['col3'];
            $to = $wrk_entry['col4'];
            $reason = $wrk_entry['col5'];
            $prev_salary = $wrk_entry['col6'];

            $stmt4 = $conn->prepare("INSERT INTO workexperience_tbl(applicant_id, vacancy_id, organization, start_date, end_date, position_held, reason_for_leaving, salary) VALUES (?,?,?,?,?,?,?,?)");
            $stmt4->bindParam(1, $app_id, PDO::PARAM_INT);
            $stmt4->bindParam(2, $id, PDO::PARAM_STR);
            $stmt4->bindParam(3, $organization, PDO::PARAM_STR);
            $stmt4->bindParam(4, $from, PDO::PARAM_STR);
            $stmt4->bindParam(5, $to, PDO::PARAM_STR);
            $stmt4->bindParam(6, $position, PDO::PARAM_STR);
            $stmt4->bindParam(7, $reason, PDO::PARAM_STR);
            $stmt4->bindParam(8, $prev_salary, PDO::PARAM_STR);
            $result=$stmt4->execute();
            }
            if(isset($result)){
                echo '<div class="alert alert-success">
                <h6>You have saved your application, you can continue from where you left off later</h6>
                </div>';            
            }
            else{
                echo '<div class="alert alert-danger">
            <h6>There was an error, please try again</h6>
            </div>';            
            }
    }
        else{
            $sql="SELECT *, MAX(applicant_id) AS maximum FROM job_applicants_tbl";
            $result = $conn->query($sql);
            $row = $result->fetch();
            $old_app_id = $row['maximum'];
            if(empty($old_app_id)){
                $app_id = 1;
            }else {
                $app_id = $old_app_id + 1;
            }
            $application_date = date("Y-m-d");
            $submit_stat = 'incomplete';

            //Save uploaded files
            if(empty($_FILES)){ 
                $cv_name .= $row['cv_upload'];       
            }else{
                $cv = $_FILES["cv"]["name"];
                $target_dir="cv_uploads/";
                $fileExt = strtolower(pathinfo($cv,PATHINFO_EXTENSION));
                if($fileExt != 'pdf'){
                    echo '<div class="alert alert-danger">
                    <h6>Please upload your CV in PDF format</h6>
                    </div>';
                exit();
                }  
                else{  
                    $cv_name .= $app_id.'.'.$fileExt;
                    $filenamearr=explode(".", $_FILES["cv"]["name"]);
                    move_uploaded_file($_FILES["cv"]["tmp_name"],$target_dir.$cv_name);
                }                 
            }

            //select details from job_vacancy_tbl
            $sql2="SELECT * FROM job_vacancy_tbl WHERE vacancy_id='$id'";
            $result2=$conn->query($sql2);
            $row2 = $result2->fetch();
            
            $vacancy_category=$row2['vacancy_category_id'];
            $emp_type=$row2['employment_type'];
            $dept_id=$row2['department_id'];
            $post_id=$row2['post_id'];

            //Insert values into the job_applicants_tbl        
            $stmt=$conn->prepare("INSERT INTO job_applicants_tbl(applicant_id, uid, vacancy_category_id, vacancy_id, employment_type, department_id, position_id, title, surname, first_name, other_name, sex, dob, marital_status, nationality, state_of_origin, lga, hometown, phone_number, alt_phone_number, email, street, city, state_of_residence, cv_upload, application_message, application_date, submit_status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $stmt->bindParam(1, $app_id, PDO::PARAM_INT);
            $stmt->bindParam(2, $uid, PDO::PARAM_INT);
            $stmt->bindParam(3, $vacancy_category, PDO::PARAM_INT);
            $stmt->bindParam(4, $id, PDO::PARAM_STR);
            $stmt->bindParam(5, $emp_type, PDO::PARAM_INT);
            $stmt->bindParam(6, $dept_id, PDO::PARAM_INT);
            $stmt->bindParam(7, $post_id, PDO::PARAM_INT);
            $stmt->bindParam(8, $title, PDO::PARAM_STR);
            $stmt->bindParam(9, $surname, PDO::PARAM_STR);
            $stmt->bindParam(10, $fname, PDO::PARAM_STR);
            $stmt->bindParam(11, $other_name, PDO::PARAM_STR);
            $stmt->bindParam(12, $gender, PDO::PARAM_STR);
            $stmt->bindParam(13, $dob, PDO::PARAM_STR);
            $stmt->bindParam(14, $m_status, PDO::PARAM_STR);
            $stmt->bindParam(15, $nationality, PDO::PARAM_STR);
            $stmt->bindParam(16, $state_of_origin, PDO::PARAM_STR);
            $stmt->bindParam(17, $lga, PDO::PARAM_STR);
            $stmt->bindParam(18, $hometown, PDO::PARAM_STR);
            $stmt->bindParam(19, $phone1, PDO::PARAM_STR);
            $stmt->bindParam(20, $phone2, PDO::PARAM_STR);
            $stmt->bindParam(21, $email, PDO::PARAM_STR);
            $stmt->bindParam(22, $address, PDO::PARAM_STR);
            $stmt->bindParam(23, $city, PDO::PARAM_STR);
            $stmt->bindParam(24, $state_of_residence, PDO::PARAM_STR);
            $stmt->bindParam(25, $cv_name, PDO::PARAM_STR);
            $stmt->bindParam(26, $application_message, PDO::PARAM_STR);
            $stmt->bindParam(27, $application_date, PDO::PARAM_STR);
            $stmt->bindParam(28, $submit_stat, PDO::PARAM_STR);
            $stmt->execute();

            $educ_detail=json_decode($educ_details, true);
            foreach($educ_detail as $educ_entry){
                $institution = $educ_entry['col1'];                $school_location = $educ_entry['col2'];
                $from = $educ_entry['col3'];
                $to = $educ_entry['col4'];
                $course = $educ_entry['col5'];
                $degree = $educ_entry['col6'];
                $class_degree = $educ_entry['col7'];
    
                $stmt2 = $conn->prepare("INSERT INTO educational_history_tbl(applicant_id, vacancy_id, institution, location, start_date, end_date, course, degree, class_of_degree) VALUES (?,?,?,?,?,?,?,?,?)");
                $stmt2->bindParam(1, $app_id, PDO::PARAM_INT);
                $stmt2->bindParam(2, $id, PDO::PARAM_STR);
                $stmt2->bindParam(3, $institution, PDO::PARAM_STR);
                $stmt2->bindParam(4, $school_location, PDO::PARAM_STR);
                $stmt2->bindParam(5, $from, PDO::PARAM_STR);    
                $stmt2->bindParam(6, $to, PDO::PARAM_STR);
                $stmt2->bindParam(7, $course, PDO::PARAM_STR);
                $stmt2->bindParam(8, $degree, PDO::PARAM_STR);
                $stmt2->bindParam(9, $class_degree, PDO::PARAM_STR);
                $stmt2->execute();
            }
    
            
    
            $ref_detail=json_decode($ref_details, true);
            foreach($ref_detail as $ref_entry){
                $ref_title = $ref_entry['col1'];
                $ref_surname = $ref_entry['col2'];
                $ref_othername = $ref_entry['col3'];
                $ref_phone = $ref_entry['col4'];
                $ref_mail = $ref_entry['col5'];
                $ref_org = $ref_entry['col6'];
                $ref_designation = $ref_entry['col7'];
    
                $stmt3 = $conn->prepare("INSERT INTO referees_tbl(applicant_id, vacancy_id, title, surname, other_names, organization, designation, phone_number, email) VALUES (?,?,?,?,?,?,?,?,?)");
                $stmt3->bindParam(1, $app_id, PDO::PARAM_INT);
                $stmt3->bindParam(2, $id, PDO::PARAM_STR);
                $stmt3->bindParam(3, $ref_title, PDO::PARAM_STR);
                $stmt3->bindParam(4, $ref_surname, PDO::PARAM_STR);
                $stmt3->bindParam(5, $ref_othername, PDO::PARAM_STR);
                $stmt3->bindParam(6, $ref_org, PDO::PARAM_STR);
                $stmt3->bindParam(7, $ref_designation, PDO::PARAM_STR);
                $stmt3->bindParam(8, $ref_phone, PDO::PARAM_STR);
                $stmt3->bindParam(9, $ref_mail, PDO::PARAM_STR);
                $stmt3->execute();
            }
    
            
            $wrk_detail=json_decode($wrk_details, true);
            foreach($wrk_detail as $wrk_entry){
                $organization = $wrk_entry['col1'];
                $position = $wrk_entry['col2'];
                $from = $wrk_entry['col3'];
                $to = $wrk_entry['col4'];
                $reason = $wrk_entry['col5'];
                $prev_salary = $wrk_entry['col6'];
    
                $stmt4 = $conn->prepare("INSERT INTO workexperience_tbl(applicant_id, vacancy_id, organization, start_date, end_date, position_held, reason_for_leaving, salary) VALUES (?,?,?,?,?,?,?,?)");
                $stmt4->bindParam(1, $app_id, PDO::PARAM_INT);
                $stmt4->bindParam(2, $id, PDO::PARAM_STR);
                $stmt4->bindParam(3, $organization, PDO::PARAM_STR);
                $stmt4->bindParam(4, $from, PDO::PARAM_STR);
                $stmt4->bindParam(5, $to, PDO::PARAM_STR);
                $stmt4->bindParam(6, $position, PDO::PARAM_STR);
                $stmt4->bindParam(7, $reason, PDO::PARAM_STR);
                $stmt4->bindParam(8, $prev_salary, PDO::PARAM_STR);
                $final_result=$stmt4->execute();
                }

            if(isset($final_result)){
                echo '<div class="alert alert-success">
                <h6>You have saved your application, you can continue from where you left off later</h6>
                </div>';
            }
            else{
                echo '<div class="alert alert-danger">
                <h6>There was an error, please try again</h6>
                </div>';
            }

    }
    
}

//Control to populate job application fields for a saved application
if($dataname == 'populate_data'){
    $sq = "SELECT * FROM job_applicants_tbl WHERE (vacancy_id='$id' AND uid='$uid') AND (submit_status='incomplete')";
    $reslt = $conn->query($sq);
    $lst = $reslt->fetch();
    if($reslt->rowCount() > 0){
        $app_id = $lst['applicant_id'];
        $data['title'] = $lst['title'];
        $data['other_name'] = $lst['other_name'];
        $data['gender'] = $lst['sex'];
        $data['marital_status'] = $lst['marital_status'];
        $data['dob'] = $lst['dob'];
        $data['nationality'] = $lst['nationality'];
        $data['states'] = $lst['state_of_origin'];
        $data['lga'] = $lst['lga'];
        $data['hometown'] = $lst['hometown'];
        $data['email'] = $lst['email'];
        $data['phone1'] = $lst['phone_number'];
        $data['phone2'] = $lst['alt_phone_number'];
        $data['address'] = $lst['street'];
        $data['city'] = $lst['city'];
        $data['state_of_residence'] = $lst['state_of_residence'];
        $data['app_message'] = $lst['application_message'];
        $data['cv'] = $lst['cv_upload'];
        $stt=$lst['state_of_origin'];


        $que="SELECT state_id FROM states WHERE state_name='$stt'";
        $ret=$conn->query($que);
        $st=$ret->fetch();
        $stid=$st['state_id'];

        $lg='';
        $qlg="SELECT * FROM lga WHERE state_id='$stid'";
        $ret=$conn->query($qlg);
        while($return = $ret->fetch()){
            $lg .='<option value="'.$return['lga_id'].'">'.ucfirst($return['lga_name']).'</option>';
        }
        $data['lg'] = $lg;

        $e = '';
        $sql="SELECT * FROM class_of_degree"; 
                $result = $conn->query($sql);
                while($searchrow = $result->fetch()){
                $e .= '<option value='.$searchrow["degree_id"] .'>' . ucfirst($searchrow["degree"]) .'</option>';
            }
        
        $count_edu = 0;
        $sq2 = "SELECT * FROM educational_history_tbl WHERE applicant_id='$app_id' AND vacancy_id='$id'";
        $reslt2 = $conn->query($sq2);
        $lst2 = $reslt2->fetchAll();
        $educ = '';
        foreach($lst2 as $ret2){
            $inst = $ret2['institution'];
            $location = $ret2['location'];
            $start = $ret2['start_date'];
            $end = $ret2['end_date'];
            $course = $ret2['course'];
            $degree = $ret2['degree'];
            $class = $ret2['class_of_degree']; 
            
            if ($count_edu == 0){
                $educ .= '
                <div id="educ_row">
                <div class="row justify-content-center mx-auto mt-2">
                    <div class="col-lg-3 col-sm-6 mx-n2">
                        <label for="institution" class="text-muted font-weight-bold">Institution</label>
                        <input type="text" value="'.$inst.'" name="institution1" class="form-control form-control-sm institution1">
                    </div> 
                    <div class="col-lg-2 col-sm-6 mx-n2"> 
                        <label for="sch_location" class="text-muted font-weight-bold">Location</label> 
                        <input  name="sch_location" placeholder="School location" value="'.$location.'" id="sch_location" class="form-control form-control-sm">
                    </div>  
                    <div class="col-lg col-sm-6 mx-n2">
                        <label for="institution_from" class="text-muted font-weight-bold">From</label> 
                        <input type="date" name="institution_from" value="'.$start.'" class="form-control form-control-sm">
                    </div> 
                    <div class="col-lg col-sm-6 mx-n2">
                        <label for="institution_to" class="text-muted font-weight-bold">To</label> 
                        <input type="date" name="institution_to" value="'.$end.'" class="form-control form-control-sm mx-n2">
                    </div> 
                    <div class="col-lg-3 col-sm-6 mx-n2"> 
                        <label for="course" class="text-muted font-weight-bold mx-n2">Course</label> 
                        <input type="text" value="'.$course.'" name="course" class="form-control form-control-sm"> 
                    </div> 
                    <div class="col-lg-1 col-sm-6 mx-n2"> 
                        <label for="degree" class="text-muted font-weight-bold">Degree</label>
                        <input type="text" name="degree" value="'.$degree.'" class="form-control form-control-sm">
                    </div>
                    <div class="col-lg-1 col-sm-6 mx-n2">
                        <label for="" class="text-muted font-weight-bold">Class</label>
                        <select name="class_of_degree" id="class_of_degree" class="form-control form-control-sm"> 
                            <option value="">'.$class.'</option>'.$e.'
                        </select>
                    </div> 
                </div>
            </div>';   
            }
            else {
                $educ .= '
                <div id="educ_row">
                    <div class="row justify-content-center mx-auto mt-2">
                        <div class="col-lg-3 col-sm-6 mx-n2">
                            <input type="text" value="'.$inst.'" name="institution1" class="form-control form-control-sm institution1">
                        </div> 
                        <div class="col-lg-2 col-sm-6 mx-n2">
                            <input  name="sch_location" value="'.$location.'" placeholder="School location" id="sch_location" class="form-control form-control-sm">
                        </div>  
                        <div class="col-lg col-sm-6 mx-n2">
                            <input type="date" name="institution_from" value="'.$start.'" class="form-control form-control-sm">
                        </div> 
                        <div class="col-lg col-sm-6 mx-n2"> 
                            <input type="date" name="institution_to" value="'.$end.'" class="form-control form-control-sm mx-n2">
                        </div> 
                        <div class="col-lg-3 col-sm-6 mx-n2">
                            <input type="text" value="'.$course.'" name="course" class="form-control form-control-sm"> 
                        </div> 
                        <div class="col-lg-1 col-sm-6 mx-n2">
                            <input type="text" name="degree" value="'.$degree.'" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-1 col-sm-6 mx-n2">
                            <select name="class_of_degree" id="class_of_degree" class="form-control form-control-sm"> 
                                <option value="">'.$class.'</option>'.$e.'
                            </select>
                        </div> 
                    </div>
                </div>';
            }
            $count_edu++;            
        }
        
        $data['educ']=$educ;
        $count_wrk = 0;       

        $sq3 = "SELECT * FROM workexperience_tbl WHERE applicant_id='$app_id' AND vacancy_id='$id'";
        $reslt3 = $conn->query($sq3);
        $lst3 = $reslt3->fetchAll();
        $wrk = '';
        foreach($lst3 as $ret3){
            $org = $ret3['organization'];
            $start = $ret3['start_date'];
            $end = $ret3['end_date'];
            $position = $ret3['position_held'];
            $reason = $ret3['position_held'];
            $salary = $ret3['salary'];

            if($count_wrk == 0){
                $wrk .= '
                <div id="work_row">
                    <div class="row mx-auto mt-2 justify-content-center">
                        <div class="col-lg-3 col-sm-6 mx-n2">
                            <label for="organization" class="text-muted font-weight-bold">Organization</label>
                            <input type="text" value="'.$org.'" placeholder="Previous Organization" name="prev_organization" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-3 col-sm-6 mx-n2">
                            <label for="position_held" class="text-muted font-weight-bold">Position Held</label>
                            <input type="text" value="'.$position.'" placeholder="Enter position held" name="position_held" class="form-control form-control-sm">
                        </div> 
                        <div class="col-lg col-sm-6 mx-n2">
                            <label for="organization" class="text-muted font-weight-bold">From</label> 
                            <input type="date" value="'.$start.'" name="organization_from" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2"> 
                            <label for="organization" class="text-muted font-weight-bold">To</label>
                            <input type="date" value="'.$end.'"  name="organization_to" class="form-control form-control-sm"> 
                        </div> 
                        <div class="col-lg-3 col-sm-6 mx-n2">
                            <label for="reason_for_leaving" class="text-muted font-weight-bold">Reason for leaving</label> 
                            <input type="text" value="'.$reason.'" placeholder="Reason for living" name="reason_for_leaving" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-1 col-sm-6 mx-n2"> 
                            <label for="prev_salary" class="text-muted font-weight-bold">Salary</label>
                            <input type="text" value="'.$salary.'" placeholder="Salary" name="prev_salary" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>';                
            }
            else{
                $wrk .= '
                <div id="work_row">
                    <div class="row mx-auto mt-2 justify-content-center">
                        <div class="col-lg-3 col-sm-6 mx-n2">
                            <input type="text" placeholder="Previous Organization" name="prev_organization" value="'.$org.'" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-3 col-sm-6 mx-n2">
                            <input type="text" placeholder="Enter position held" name="position_held" value="'.$position.'"  class="form-control form-control-sm">
                        </div> 
                        <div class="col-lg col-sm-6 mx-n2"> 
                            <input type="date" value="'.$start.'" name="organization_from" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2"> 
                            <input type="date" value="'.$end.'"  name="organization_to" class="form-control form-control-sm"> 
                        </div> 
                        <div class="col-lg-3 col-sm-6 mx-n2"> 
                            <input type="text" placeholder="Reason for living" name="reason_for_leaving" value="'.$reason.'" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-1 col-sm-6 mx-n2"> 
                            <input type="text" placeholder="Salary" name="prev_salary" value="'.$salary.'"  class="form-control form-control-sm">
                        </div>
                    </div>
                </div>';
            }
            $count_wrk++;
        }
        $data['wrk']=$wrk;

        $sq4 = "SELECT * FROM referees_tbl WHERE applicant_id='$app_id' AND vacancy_id='$id'";
        $reslt4 = $conn->query($sq4);
        $lst4 = $reslt4->fetchAll();
        $ref = '';
        $count_ref = 0;
        foreach($lst4 as $ret4){
            $title = $ret4['title'];
            $surname = $ret4['surname'];
            $other_name = $ret4['other_names'];
            $org = $ret4['organization'];
            $desig = $ret4['designation'];
            $phone_num = $ret4['phone_number'];
            $email = $ret4['email'];

            $r = '';
            $sql="SELECT * FROM titles";
                    $result = $conn->query($sql);
                    while($searchrow = $result->fetch()){
                        $r .= "<option value=".$searchrow['titleid'] .">" . ucfirst($searchrow['title']) ."</option>";
                        }  

            if($count_ref == 0){
                $ref .= '
                <div id="ref_row">
                    <div class="row mx-auto justify-content-center mt-2">
                        <div class="col-lg-1 col-sm-6 mx-n2">
                            <label for="ref_title" class="text-muted font-weight-bold">Title</label>
                            <select name="ref_title" id="ref_title" class="form-control form-control-sm"><option value="">'. $title.'</option>'.$r.'   
                            </select>
                        </div>
                        <div class="col-lg col-sm-6 mx-n2">
                            <label for="ref_surname" class="text-muted font-weight-bold">Surname</label> 
                            <input type="text" name="ref_surname" id="ref_surname" value="'.$surname.'" placeholder="Surname" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2">
                            <label for="ref_other_names" class="text-muted font-weight-bold">Other Names</label> 
                            <input type="text" name="ref_other_names" id="ref_other_names" value="'.$other_name.'" placeholder="Other Names" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2">
                            <label for="ref_phone_number" class="text-muted font-weight-bold">Phone Number</label> 
                            <input type="text" name="ref_phone_number" id="ref_phone_number" placeholder="Phone Number" value="'.$phone_num.'" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-3 col-sm-6 mx-n2">
                            <label for="ref_email" class="text-muted font-weight-bold">Email</label> 
                            <input type="text" name="ref_email" id="ref_email" placeholder="Email" value="'.$email.'" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2">
                            <label for="ref_org" class="text-muted font-weight-bold">Organization</label> 
                            <input type="text" name="ref_org" id="ref_org" placeholder="Organization" value="'.$org.'" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2">
                            <label for="ref_designation" class="text-muted font-weight-bold">Designation</label>
                            <input type="text" name="ref_designation" id="ref_designation" placeholder="Designation" value="'.$desig.'" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                ';
            } 
            else{
                $ref .= '
                <div id="ref_row">
                    <div class="row mx-auto justify-content-center mt-2">
                        <div class="col-lg-1 col-sm-6 mx-n2">
                            <select name="ref_title" id="ref_title" class="form-control form-control-sm"><option value="">'. $title.'</option>'.$r.'   
                            </select>
                        </div>
                        <div class="col-lg col-sm-6 mx-n2">
                            <input type="text" name="ref_surname" id="ref_surname" value="'.$surname.'" placeholder="Surname" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2">
                            <input type="text" name="ref_other_names" id="ref_other_names" value="'.$other_name.'" placeholder="Other Names" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2">
                            <input type="text" name="ref_phone_number" id="ref_phone_number" placeholder="Phone Number" value="'.$phone_num.'" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg-3 col-sm-6 mx-n2">
                            <input type="text" name="ref_email" id="ref_email" placeholder="Email" value="'.$email.'" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2"> 
                            <input type="text" name="ref_org" id="ref_org" placeholder="Organization" value="'.$org.'" class="form-control form-control-sm">
                        </div>
                        <div class="col-lg col-sm-6 mx-n2">
                            <input type="text" name="ref_designation" id="ref_designation" placeholder="Designation" value="'.$desig.'" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                ';

            }
            $count_ref++;

        }
        $data['ref']=$ref;


        echo json_encode($data);    

    }
    else{
        echo '';
    }

}

//Control to update user profile
if($dataname=='update_profile'){
    $sq1 = "UPDATE accounts_tbl SET fname='$fname', lname='$surname', phone_number='$phone_num' WHERE uid='$uid'";
    $stm = $conn->query($sq1);

    $sql = "UPDATE job_users SET fname='$fname', lname='$surname', other_name='$other_name', phone_number='$phone_num', email='$email' WHERE uid='$uid'";
    $stmt = $conn->query($sql);
    if(isset($stmt)){
        echo '<div class="alert alert-success">
        <h6>You have successfully update your profile</h6>
        </div>';
    }else{
        echo '<div class="alert alert-danger">
        <h6>There was an error, please try again</h6>
        </div>';
    }
}

//Control to update user password
if($dataname=='update_password'){
    $pass=sha1($newpass);
    $cpass=sha1($cnewpass);
    $currpass=sha1($oldpass);

    if($pass!=$cpass){
        echo '<div class="alert alert-danger">
                <h6>Passwords do not match</h6>
            </div>';  
        exit();        
    }
    else{
        $sql = "SELECT * FROM job_users WHERE uid='$uid'";
        $result=$conn->query($sql);
        $row = $result->fetch();

        $stored_pass = $row['password'];
        if($currpass!=$stored_pass){
            echo '<div class="alert alert-danger">
                    <h6>Enter old password correctly</h6>
                  </div>';
        }else{
            $sql2 = "UPDATE job_users SET password='$pass'";
            $result=$conn->query($sql2);
            if(isset($result)){
                echo '<div class="alert alert-success">
                        <h6>Password updated successfully</h6>
                    </div>';
            }
            else{
                echo '<div class="alert alert-danger">
                            <h6>Something went wrong, please try  again</h6>
                       </div>'; 
            }

        }
         
    }

}


if($dataname=='validate_elig'){

    $sql = "SELECT COUNT(expected_answer) as cnt_sum FROM eligibility_questions_tbl WHERE vacancy_id='$vacid'";
    $reslt = $conn->query($sql);
    $ret = $reslt->fetch(PDO::FETCH_ASSOC);
    $cnt_ans = $ret['cnt_sum'];

    $score = 0;
    $check = 0;

    $responses=json_decode($responses, true);
    foreach($responses as $replies){
        $qid = $replies['col2'];
        $ans = $replies['col1'];
        $sq = "SELECT * FROM eligibility_questions_tbl WHERE question_id='$qid'";
        $result = $conn->query($sq);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $exp_ans=$row['expected_answer'];
        $ans_type=$row['type'];
        if($ans == $exp_ans){
            $score += 1;
        }
        else{
            if($ans_type == 'Compulsory'){
                $check += 1;
            }
            else{
                $check = $check;
            }
            $score = $score;
        }
    }

    if ($check > 0){
        $tscore = 0;
    }
    else{
        $tscore = $score;
    }

    if($tscore > 0){
        $sq2 = "DELETE FROM eligibility_responses WHERE uid='$uid' AND vacancy_id='$vacid'";
        $stmt=$conn->query($sq2);

        foreach($responses as $replies){
            $qid = $replies['col2'];
            $ans = $replies['col1'];
            $stmt2=$conn->prepare("INSERT INTO eligibility_responses (uid, qid, vacancy_id, response) VALUES (?,?,?,?)");
            $stmt2->bindParam(1, $uid, PDO::PARAM_INT);
            $stmt2->bindParam(2, $qid, PDO::PARAM_INT);
            $stmt2->bindParam(3, $vacid, PDO::PARAM_STR);
            $stmt2->bindParam(4, $ans, PDO::PARAM_INT);
            $stmt2->execute();
        }
        echo 'passed';        
    }else{
        echo 'failed';
    }

}

if($dataname=='registration'){
    $sql="SELECT * FROM job_users WHERE uid='$uid' AND email='$usermail'";
    $smt=$conn->query($sql);
    $reslt = $conn->query($sql);
    $ret = $reslt->fetch(PDO::FETCH_ASSOC);
    if($reslt->rowCount() > 0){
        echo '<div class="alert alert-danger">
                <h6>Email registered already, go back to login</h6>
              </div>';
    }
    else{
        $pass=sha1($reg_pass);
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
                    <h6>Registration Successful. Login and continue application</h6>
                </div>';
        }else{
            echo '<div class="alert alert-danger">
                    <h6>Error! Please try again</h6>
                </div>';                
        }
    }

}

if($dataname=='loginuser'){
    session_start();
    $passwrd=sha1($reg_pass);

        $sql = "SELECT * FROM job_users WHERE email='$usermail' AND password='$passwrd'";
        $result = $conn->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);
         
        if($result->rowCount() > 0){
            $_SESSION['user'] = $row['email'];
            echo 'successful';
        }
        else{
            echo '<div class="alert alert-danger">
                <h6>Wrong Login details! Please check your Pasword</h6>
            </div>';
        }           
}



?>